<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Links extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '連結管理';
		$this->abrv = 'hist_link_';
		$this->load->model('Links_model', 'models');

		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			'hist_link_title' => array('dataType'=>'string', 'name'=>'標題'),
			'hist_link_url'=> array('dataType'=>'string', 'name'=>'外部連結'),
			'hist_link_id'=> array('dataType'=>'integer', 'name'=>'流水號'),
		);
		$this->haveField = array('hist_link_title', 'hist_link_url');
		$this->histLinkId = 1;
	}


	public function index(){

		$id = $this->histLinkId;

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

			// 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($saveField, $haveField, $dataList);

			$status = $this->models->updateData($updateData);

			if($status){
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
