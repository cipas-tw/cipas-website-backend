<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/*
	================ 多檔上傳 ===============

	*	upload($Field , $path, $allowed_types, $tn, $crop, $cropSize)
	*	$Field ：　傳送的file name
	*	$path  ：　儲存路徑　
	*	$tn    ： 是否縮圖 TRUE or FALSE　，預設FALSE
	*	$crop ： 是否裁切 TRUE or FALSE，預設TRUE
	*   $cropSize : 縮圖才切尺寸，預設 defultCropSize

	*/
	function upload_file_array($Field, $path, $allowed_types = array(), $tn='', $crop = TRUE, $cropSize = 'defultCropSize')
	{

		if(empty($_FILES[$Field]["tmp_name"])){
			return false;
		}

		//檢查目錄是否存在
		$urls = explode('/', $path);
		$path = '';
		foreach($urls as $va){
			$path .= $va.'/';
			if( !is_dir($path) ){
				mkdir($path, 0777);
			}
		}
		$path = './'.$path;

		$data = array();
		$allowed_types = $allowed_types? $allowed_types : array('jpg','jpeg','png','pdf','xlsx','xls','doc','docx','ppt','pptx');
		$count = count($_FILES[$Field]["tmp_name"]);

		for ($i = 0 ; $i<$count ; $i++)
		{
			if(!empty($_FILES[$Field]["tmp_name"][$i]))
			{
				$ext = strtolower(pathinfo($_FILES[$Field]["name"][$i], PATHINFO_EXTENSION));//取副檔名

				if(in_array($ext,$allowed_types))
				{
					$filename = date('ymdHis').'_'.rand(10,99).'.'.$ext;
					move_uploaded_file($_FILES[$Field]["tmp_name"][$i] ,$path.$filename);

					$data[] = array(
						'orig_name' => $_FILES[$Field]["name"][$i],
						'file_name' => $filename,
					);

				}else{
					$data[] = array('error' => '檔案副檔名錯誤');
				}
			}else{
				$data[] = array('error' => '無檔案');
			}
		}
		return $data;
	}

	/*
	================ 單檔上傳 ===============

	*	upload($Field , $path, $allowed_types, $tn, $crop, $cropSize)
	*	$Field ：　傳送的file name
	*	$path  ：　儲存路徑　
	*	$tn    ： 是否縮圖 TRUE or FALSE　，預設FALSE
	*	$crop ： 是否裁切 TRUE or FALSE，預設TRUE
	*   $cropSize : 縮圖才切尺寸，預設 defultCropSize

	*/
	function upload($Field, $folder, $path, $allowed_types = array(), $tn='', $crop = TRUE, $cropSize = 'defultCropSize')
	{
		$allowed_types = $allowed_types? $allowed_types : array('jpg','jpeg','png','pdf','xlsx','xls','doc','docx','ppt','pptx');

		$CI =& get_instance(); // 設定ci 來源

		//檢查目錄是否存在
		$urls = explode('/', $folder.$path);
		$upload_path = '';
		foreach($urls as $va){
			$upload_path .= $va.'/';
			if( !is_dir($upload_path) ){
				mkdir($upload_path, 0777);
			}
		}
		$upload_path = './'.$upload_path;

		$config['upload_path']   = $upload_path;
		$config['allowed_types'] = implode($allowed_types, '|');
		$config['encrypt_name']  = TRUE;
		$CI->load->library('upload',$config);
		$CI->upload->initialize($config);

		$data;
		$error="";
		if ($CI->upload->do_upload($Field))
		{
			$fInfo = $CI->upload->data();

			if(in_array($fInfo['image_type'], array('jpg','jpeg','png'))){
				$file_name = $CI->upload->data('file_name');
				if($tn == TRUE)
				{
					$filePath = $upload_path.$file_name;
					$cropSizeList = $CI->config->item($cropSize);

					// 圖片裁減
					foreach($cropSizeList as $size){
						$cropThumPath = '';
						$urls = explode('/', $folder.$size['path'].$path);
						foreach($urls as $va){
							$cropThumPath .= $va.'/';
							if( !is_dir($cropThumPath) ){
								mkdir($cropThumPath, 0777);
							}
						}
						$cropThumPath = $cropThumPath.$file_name;
						ImageResize($filePath, $cropThumPath, $size['width'], $size['height'], TRUE, TRUE);
						if($crop){
							cropImage($cropThumPath, $cropThumPath, $size['width'], $size['height']);
						}
					}

				}
			}

			return $fInfo;

		}else{
			$error = array('error' => $CI->upload->display_errors());
			return $error;
		}
	}

	/*
	================ 裁切圖片 ===============

	*	$srcImage 	：　需裁切的圖片路徑
	*	$dstImage 	：　裁切後放置的路徑
	*	$width    	： 裁切後的寬度
	*	$height 	： 裁切後的高度
	*/

	function cropImage($srcImage, $dstImage, $cropWidth, $cropHeight){

		$config['source_image']		= $srcImage;
		$config['new_image']		= $dstImage;
		$config['width']			= $cropWidth;
		$config['height']			= $cropHeight;
		$config['image_library']	= 'gd2';
		$config['quality']			= 100;
		$config['x_axis']			= 0;
		$config['y_axis']			= 0;
		$config['maintain_ratio']	= FALSE;

		$resourceData = getImageResourceInfo($srcImage);

		if($resourceData['resource']){

			$srcImageWidth	= imagesx($resourceData['resource']);
			$srcImageHeight = imagesy($resourceData['resource']);

			if($srcImageWidth >= $cropWidth && $srcImageHeight >= $cropHeight){
			//原圖大於指定的裁切大小

				//計算置中位置
				$config['x_axis'] = intval(($srcImageWidth - $cropWidth) / 2);
				$config['y_axis'] = intval(($srcImageHeight - $cropHeight) / 2);
			}
		}

		$CI =& get_instance();
		$CI->load->library('image_lib');
		$CI->image_lib->initialize($config);

		if( ! $CI->image_lib->crop())
		{
			$data['success'] = FALSE;
			$data['error'] = $CI->image_lib->display_errors();
		}
		else{
			$data['success'] = TRUE;
		}

		return $data;
	}

	/*
		================ 縮圖函式 ==============

		*	$src_file :  來源檔名
		*	$dst_file :  縮圖後檔名
		*	$dst_width:　 縮圖後的寬
		*	$dst_height: 縮圖後的長
		*	$ratio: true:依照比例、false:不依照比例
		*	$fllowBigSize: true:依最大邊縮圖、false:依最小邊縮圖
	*/

	function ImageResize($src_file, $dst_file, $dst_width='', $dst_height='' , $ratio=true, $fllowBigSize=false){

		if($dst_width <1 || $dst_height <1)
		{
			echo "params width or height error !";
			exit;
		}

		if(!file_exists($src_file))
		{
			echo $src_file . " is not exists !";
			exit;
		}

		//是否符合圖片檔名
		$type = exif_imagetype($src_file);
		$support_type = array(IMAGETYPE_JPEG , IMAGETYPE_PNG , IMAGETYPE_GIF);

		if(!in_array($type, $support_type,true))
		{
			echo "this type of image does not support! only support jpg , gif or png";
			exit;
		}

		//新增圖檔容器
		switch($type)
		{
			case IMAGETYPE_JPEG :
				$src_img = imagecreatefromjpeg($src_file);
			break;
			case IMAGETYPE_PNG :
				$src_img = imagecreatefrompng($src_file);
			break;
			case IMAGETYPE_GIF :
				$src_img = imagecreatefromgif($src_file);
			break;
			default:
				echo "Load image error!";
				exit;
		}

		$src_w = imagesx($src_img);
		$src_h = imagesy($src_img);

		$ratio_w=1.0 * $dst_width/$src_w;
		$ratio_h=1.0 * $dst_height/$src_h;

		 //不按照比例縮放
		if($ratio == false){

			$zoom_img = imagecreatetruecolor($dst_width, $dst_height);
			imagecopyresampled($zoom_img,$src_img,0,0,0,0,$dst_width,$dst_height,$src_w,$src_h);

		}else{//按照比例縮圖

			//計算比例
			$dstwh = $dst_width/$dst_height;
			$srcwh = $src_w/$src_h;
			if (!$fllowBigSize) {
				if ($ratio_w <= $ratio_h)
				{
					$zoom_w = $dst_width;
					$zoom_h = $zoom_w*($src_h/$src_w);
				}else{
					$zoom_h = $dst_height;
					$zoom_w = $zoom_h*($src_w/$src_h);
				}
			} else {
				if ($ratio_w <= $ratio_h)
				{
					$zoom_h = $dst_height;
					$zoom_w = $zoom_h*($src_w/$src_h);
				}else{
					$zoom_w = $dst_width;
					$zoom_h = $zoom_w*($src_h/$src_w);
				}
			}

			$zoom_img=imagecreatetruecolor($zoom_w, $zoom_h);
			imagecopyresampled($zoom_img,$src_img,0,0,0,0,$zoom_w,$zoom_h,$src_w,$src_h);
		}

		switch($type) {
				case IMAGETYPE_JPEG :
					imagejpeg($zoom_img,$dst_file,100);
				break;
				case IMAGETYPE_PNG :
					imagepng($zoom_img,$dst_file);
				break;
				case IMAGETYPE_GIF :
					imagegif($zoom_img,$dst_file);
				break;
				default:
				break;
		}
	}

	function getImageResourceInfo($srcPic){
	//依照圖片類型取得resource、圖片類型和副檔名

		$data['imgType'] = exif_imagetype($srcPic);

		switch($data['imgType']){

			case IMAGETYPE_GIF:
				$data['resource']		= imagecreatefromgif($srcPic);
				$data['fileExtension']	= '.gif';
				break;

			case IMAGETYPE_JPEG:
				$data['resource']		= imagecreatefromjpeg($srcPic);
				$data['fileExtension']	= '.jpg';
				break;

			case IMAGETYPE_PNG:
				$data['resource']		= imagecreatefrompng($srcPic);
				$data['fileExtension']	= '.png';
				break;

			default:
				$data['resource']		= NULL;
				$data['fileExtension']	= NULL;
				break;
		}
		return $data;
	}
