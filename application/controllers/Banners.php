<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '首頁輪播牆';
		$this->abrv = 'slider_banner_';
		$this->load->model('Banners_model', 'models');

		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			$this->abrv.'title' => array('dataType'=>'string', 'name'=>'標題'),
			$this->abrv.'orig_filename'=> array('dataType'=>'string', 'name'=>'附件檔名'),
			$this->abrv.'filename'=> array('dataType'=>'string', 'name'=>'附件檔名'),
			$this->abrv.'type'=> array('dataType'=>'string', 'name'=>'輪播類型'),
			$this->abrv.'url'=> array('dataType'=>'string', 'name'=>'連結'),
			$this->abrv.'id'=> array('dataType'=>'integer', 'name'=>'流水號'),
		);
		$this->haveField = array($this->abrv.'title');

		$this->uploadFolder = $this->config->item('uploadPath');
		$this->tmpPath = $this->config->item('tmpPath');
		$this->uploadPath = $this->config->item('sliderBannerPath');
		$this->deletePath = $this->config->item('deletePath');
		$this->cropSizeList = $this->config->item('sliderCropSize');
		$this->sliderBannerType = $this->config->item('sliderBannerType');
	}


	public function index(){
		$data = [];
		$data['head']['includeCss'] = 'datatables';
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['abrv'] = $this->abrv;
		$data['unit'] = $this->unit;

		// 搜尋
		$queryData['keyword'] = trim($this->input->get('keyword', true));
		$data['queryData'] = $queryData;

		// 取資料
		$data['result'] = $this->models->getList($queryData, [0,0]);
		$data['typeList'] = $this->sliderBannerType;
		$data['imagePath'] = $this->uploadFolder.$this->uploadPath.$this->cropSizeList[1]['path'];
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView($this->controllerName.'/index', $data);
	}

	public function create(){
		$op = $this->input->post('op', true);
		if( $op === 'add' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);
			$dataList = $this->input->post();

			if(isset($dataList['tmp_img_file_url']) && $dataList['tmp_img_file_url'] !='' && $dataList['slider_banner_type'] ==1 ){
				$dataList[$this->abrv.'orig_filename'] = $dataList['tmp_img_filename'];
				$dataList[$this->abrv.'filename'] = $dataList['tmp_img_file_url'];

				// 移動封面圖片
				foreach($this->cropSizeList as $size){

					$tmpPath = $this->uploadFolder.$this->tmpPath.$size['path'].$dataList[$this->abrv.'filename'];
					$filePath = $this->uploadFolder.$this->uploadPath.$size['path'].$dataList[$this->abrv.'filename'];
					$this->moveFile($tmpPath, $filePath);
				}
			}

			// 儲存資料組成&檢查必填欄位
			$addData = $this->postFieldChekck($this->saveField, $this->haveField, $dataList);

			$status = $this->models->addData($addData);
			if($status){
				$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertAddSuccess');
				$this->showAlerts($alerts);
				redirect($HTTP_REFERER);
			}else{
				$alerts[$this->config->item('alertWarning')] = $this->config->item('alertDBError');
				$this->showAlerts($alerts);
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		$data = [];
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['unit'] = $this->unit;
		$data['abrv'] = $this->abrv;
		$data['unit'] = $this->unit;
		$data['typeList'] = $this->sliderBannerType;
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView($this->controllerName.'/'.__FUNCTION__, $data);
	}

	public function edit($id){
		// 資料檢查
		$data = [];
		$data['result'] = $this->models->getData($id);
		if($id =='' || !isset($data['result'])){
			$alerts[$this->config->item('alertDanger')] = '查無此資料，請重新進入編輯頁面';
			$this->showAlerts($alerts);
			redirect('/'.$this->controllerName.'/');
		}

		$op = $this->input->post('op', true);
		if( $op === 'upd' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);
			$dataList = $this->input->post(null, true);

			$saveField = $this->saveField;
			$haveField = $this->haveField;
			$haveField[] = $this->abrv.'id';
			$dataList[$this->abrv.'id'] = $data['result'][$this->abrv.'id'];

			if(isset($dataList['tmp_img_file_url']) && $dataList['tmp_img_file_url'] !='' && $dataList['slider_banner_type'] ==1 ){
				$dataList[$this->abrv.'orig_filename'] = $dataList['tmp_img_filename'];
				$dataList[$this->abrv.'filename'] = $dataList['tmp_img_file_url'];

				// 移動封面圖片
				foreach($this->cropSizeList as $size){

					$tmpPath = $this->uploadFolder.$this->tmpPath.$size['path'].$dataList[$this->abrv.'filename'];
					$filePath = $this->uploadFolder.$this->uploadPath.$size['path'].$dataList[$this->abrv.'filename'];
					$this->moveFile($tmpPath, $filePath);
				}
			}

			// 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($saveField, $haveField, $dataList);

			if($dataList['slider_banner_type'] !=1 ){
				$updateData[$this->abrv.'orig_filename'] = null;
				$updateData[$this->abrv.'filename'] = null;
			}

			$status = $this->models->updateData($updateData);

			if($status){
				$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertUpdateSuccess');
				$this->showAlerts($alerts);
				redirect($HTTP_REFERER);
			}else{
				$alerts[$this->config->item('alertWarning')] = $this->config->item('alertDBError');
				$this->showAlerts($alerts);
				redirect($_SERVER['HTTP_REFERER']);
			}
		}

		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['unit'] = $this->unit;
		$data['abrv'] = $this->abrv;
		$data['imagePath'] = $this->uploadFolder.$this->uploadPath.$this->cropSizeList[1]['path'];
		$data['typeList'] = $this->sliderBannerType;
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView($this->controllerName.'/'.__FUNCTION__, $data);
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

	public function sortAjax($op, $id, $sort){
		if( $op === 'sort' ){
			$HTTP_REFERER = $_SERVER['HTTP_REFERER'];
			$updateData[$this->abrv.'id'] = $id;
			$updateData[$this->abrv.'sort'] = $sort;
			$this->models->updateData($updateData);
		}
	}
}
