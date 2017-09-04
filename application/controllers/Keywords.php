<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keywords extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '熱門搜尋';
		$this->abrv = 'hot_keyword_';
		$this->load->model('Keywords_model', 'models');

		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			$this->abrv.'title' => array('dataType'=>'array', 'name'=>'標題'),
			$this->abrv.'id'=> array('dataType'=>'array', 'name'=>'流水號'),
		);
		$this->haveField = array($this->abrv.'title', $this->abrv.'id');
		$this->histLinkId = 1;
	}


	public function index(){

		$op = $this->input->post('op', true);
		if( $op === 'upd' ){
			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);

			// 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($this->saveField, $this->haveField);
			foreach($updateData[$this->abrv.'id'] as $i=>$id){
				$setData = [];
				$setData[$this->abrv.'id'] = $id;
				$setData[$this->abrv.'title'] = $updateData[$this->abrv.'title'][$i];

				$status = $this->models->updateData($setData);
			}

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
		$data = [];
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['unit'] = $this->unit;
		$data['abrv'] = $this->abrv;
		$data['result'] = $this->models->getList([], [0,0]);
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView($this->controllerName.'/index', $data);
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
