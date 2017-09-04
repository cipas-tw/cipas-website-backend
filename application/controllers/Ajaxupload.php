<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxupload extends MY_BackendController {
	public function __construct(){
		parent::__construct();

		$this->folder = $this->config->item('uploadPath').$this->config->item('tmpPath');
		$this->deletePath = $this->config->item('uploadPath').$this->config->item('deletePath');

		$this->defultCropController = array('news');

	}

	public function uploadFile($controllerName = ''){
		
		$returnData = [];
		
		// 檔案上傳
		if(isset($_FILES['tmp_file']) || (isset($_FILES['tmp_img_file']) && $_FILES['tmp_img_file']['error'] == 0)){
			$this->load->helper('upload');
			$cropSize = 'defultCropSize';
			$uploadFile = 'tmp_file';

			$reSize = FALSE;
			$crop = FALSE;
			if($controllerName != ''){

				if($controllerName == 'members'){
					$cropSize = 'commissionerCropSize';
				} else if($controllerName == 'banners' || $controllerName == 'about'){
					$cropSize = 'sliderCropSize';
					$crop = FALSE;
				}
			}

			if(isset($_FILES['tmp_img_file'])){
				$uploadFile = 'tmp_img_file';
				$reSize = TRUE;

				// 圖片大小檢查
				if($_FILES['tmp_img_file']['tmp_name'] !== ""){
					list($width, $height) = getimagesize($_FILES['tmp_img_file']['tmp_name']);
				}
				if($cropSize == 'defultCropSize'){
					if($width != 800|| $height != 540){
						$returnData = array('status'=>0, 'message'=>'圖片大小上傳錯誤');
						echo json_encode($returnData);exit;
					}
				} else if($cropSize == 'commissionerCropSize'){
					if($width != 416|| $height != 480){
						$returnData = array('status'=>0, 'message'=>'圖片大小上傳錯誤');
						echo json_encode($returnData);exit;
					}
				}
			}
			// 檔案上傳
			$uploadPath = date('Y/m');
			$file = $_FILES[$uploadFile]['error'] == 0 ? upload($uploadFile, $this->folder, $uploadPath, FALSE, $reSize, $crop, $cropSize) : array('');
			if(isset($file['error']) && $file['error'] !=''){
				$errorMsg = strip_tags($file['error']);
				$returnData = array('status'=>0, 'message'=> $errorMsg);
			} else {
				$returnData = array(
					'status'=>1,
					'message'=>'上傳成功！',
					'file_url'=>isset($file['file_name']) ? $uploadPath.'/'.$file['file_name'] : '',
					'file_orig_name'=>isset($file['orig_name']) ? $file['orig_name'] : '',
				);
			}
		} else {
			$returnData = array('status'=>0, 'message'=>'請先選擇上傳檔案');
		}
		echo json_encode($returnData);
	}

	public function uploadPhotoFile(){
		$returnData = [];

		// 檔案上傳
		if(isset($_FILES['file'])){
			$this->load->helper('upload');
			// 檔案上傳
			$uploadPath = date('Y/m/');
			$file = $_FILES['file']['error'] == 0 ? upload('file', $this->folder, $uploadPath, FALSE, TRUE, FALSE, 'sliderCropSize') : array('');
			if(isset($file['error']) && $file['error'] !=''){
				$returnData = array('status'=>0, 'message'=>$file['error']);
			} else {
				$returnData = array(
					'status'=>1,
					'message'=>'上傳成功！',
					'file_url'=>isset($file['file_name']) ? $uploadPath.$file['file_name'] : '',
					'file_orig_name'=>isset($file['orig_name']) ? $file['orig_name'] : '',
				);
			}
		} else {
			$returnData = array('status'=>0, 'message'=>'請先選擇上傳檔案');
		}
		echo json_encode($returnData);
	}

	public function deleteAction(){
		$op = $this->input->post('op', true);
		if( $op === 'del' ){
			$deleteData[$this->abrv.'id'] = trim($this->input->post('id', true));
			$HTTP_REFERER = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
			$this->models->deleteData($deleteData);

			$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertDeleteSuccess');
			$this->showAlerts($alerts);
			redirect($HTTP_REFERER);
		}
	}
}
