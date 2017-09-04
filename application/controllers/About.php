<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '執掌與組織管理';
		$this->abrv = 'about_';
		$this->load->model('About_model', 'models');
		$this->load->model('AboutFile_model', 'fileModels');

		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			'about_responsibility_descriptionl' => array('dataType'=>'string', 'name'=>'執掌說明'),
			'about_organization_descriptionl' => array('dataType'=>'string', 'name'=>'組織說明'),
			'about_orig_name' => array('dataType'=>'string', 'name'=>'原檔名'),
			'about_name' => array('dataType'=>'string', 'name'=>'真實檔名'),
			'tmp_imagename' => array('dataType'=>'string', 'name'=>'原檔名'),
			'tmp_imageurl' => array('dataType'=>'string', 'name'=>'真實檔名'),
			'tmp_filename' => array('dataType'=>'string', 'name'=>'原檔名'),
			'tmp_file_url' => array('dataType'=>'string', 'name'=>'真實檔名'),
		);
		$this->haveField = array('about_responsibility_descriptionl', 'about_organization_descriptionl');
		$this->aboutId = 1;
		$this->uploadFolder = $this->config->item('uploadPath');
		$this->tmpPath = $this->config->item('tmpPath');
		$this->uploadPath = $this->config->item('aboutPath');
		$this->deletePath = $this->config->item('deletePath');
	}


	public function index(){

		$id = $this->aboutId;

		// 資料檢查
		$data = [];
		$data['result'] = $this->models->getData($id);
		$data['resultFile'] = $this->fileModels->getList(array($this->abrv.'id'=>$id), [0,0]);
		if($id =='' || !isset($data['result'])){
			$alerts[$this->config->item('alertDanger')] = '查無此資料，請重新進入編輯頁面';
			$this->showAlerts($alerts);
			redirect('/'.$this->controllerName.'/');
		}

		$op = $this->input->post('op', true);
		if( $op === 'upd' ){
			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);

			// // 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($this->saveField, $this->haveField, [], $HTTP_REFERER);
			$updateData['about_id'] = '1';


			if( $updateData['tmp_imagename'] !='' && $updateData['tmp_imageurl'] !='' ){
				$updateData['about_orig_name'] = $updateData['tmp_imagename'];
    			$updateData['about_name'] =  $updateData['tmp_imageurl'];

    			$tmpPath = $this->uploadFolder.$this->tmpPath.$updateData[$this->abrv.'name'];
				$filePath = $this->uploadFolder.$this->uploadPath.$updateData[$this->abrv.'name'];
				$this->moveFile($tmpPath, $filePath);
			}

    		$tmp_filename = $this->input->post('tmp_filename', true);
			$tmp_file_url = $this->input->post('tmp_file_url', true);
    		unset( $updateData['tmp_imagename'], $updateData['tmp_imageurl'],$updateData['tmp_filename'], $updateData['tmp_file_url']);
			$status = $this->models->updateData($updateData);

			if($status){

				if(isset($tmp_filename) && $tmp_filename != '' && isset($tmp_file_url) && $tmp_file_url != '' ) {

					$setData[$this->abrv.'file_orig_name'] = $tmp_filename;
					$setData[$this->abrv.'file_name'] = $tmp_file_url;

					$tmpPath = $this->uploadFolder.$this->tmpPath.$setData[$this->abrv.'file_name'];
					$filePath = $this->uploadFolder.$this->uploadPath.$setData[$this->abrv.'file_name'];
					$this->moveFile($tmpPath, $filePath);

					$setData[$this->abrv.'file_id'] = 1;
					$setData[$this->abrv.'id'] = 1;
					$status = $this->fileModels->updateData($setData);
				}

				$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertUpdateSuccess');
				$this->showAlerts($alerts);
				redirect('/'.$this->controllerName.'/');
			}else{
				$alerts[$this->config->item('alertWarning')] = $this->config->item('alertDBError');
				$this->showAlerts($alerts);
				redirect('/'.$this->controllerName.'/');
			}
		}

		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['unit'] = $this->unit;
		$data['abrv'] = $this->abrv;
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView($this->controllerName.'/index', $data);
	}

}
