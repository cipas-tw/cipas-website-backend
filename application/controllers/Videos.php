<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class videos extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '影音內容';
		$this->abrv = 'video_';
		$this->load->model('videos_model', 'models');
		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			$this->abrv.'id'=> array('dataType'=>'integer', 'name'=>'流水號'),
			$this->abrv.'title' => array('dataType'=>'string', 'name'=>'標題'),
			$this->abrv.'url' => array('dataType'=>'string', 'name'=>'連結'),
			$this->abrv.'directions' => array('dataType'=>'string', 'name'=>'說明'),
		);
		$this->haveField = array($this->abrv.'title', $this->abrv.'url', $this->abrv.'directions');
	}


	public function index(){
		$data = [];
		$data['head']['includeCss'] = 'datatables';
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['abrv'] = $this->abrv;
		$data['unit'] = $this->unit;
		$data['frontEndUrl'] = 'videos';

		// 搜尋
		$queryData['keyword'] = trim($this->input->get('keyword', true));
		$queryData[$this->abrv.'type_id'] = trim($this->input->get($this->abrv.'type_id', true));
		$queryData['startDate'] = trim($this->input->get('startDate', true));
		$queryData['endDate'] = trim($this->input->get('endDate', true));
		$data['queryData'] = $queryData;

		// 分頁
		$httpGetParams = $this->combineGetParams($queryData);
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = __FUNCTION__.'?'.$httpGetParams;
		$pageConfig['total_rows'] = $this->models->getList($queryData, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->models->getList($queryData, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView($this->controllerName.'/index', $data);
	}

	public function create(){
		$op = $this->input->post('op', true);
		if( $op === 'add' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);
			// 儲存資料組成&檢查必填欄位
			$addData = $this->postFieldChekck($this->saveField, $this->haveField);
			$this->models->addData($addData);
			$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertAddSuccess');
			$this->showAlerts($alerts);
			redirect($HTTP_REFERER);

		}

		$data = [];
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['template']['abrv'] = $this->abrv;
		$data['unit'] = $this->unit;
		$data['abrv'] = $this->abrv;
		$data['unit'] = $this->unit;
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
			// 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($this->saveField, $this->haveField);
			$this->models->updateData($updateData);
			$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertUpdateSuccess');
			$this->showAlerts($alerts);
			redirect($HTTP_REFERER);
		}
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['template']['abrv'] = $this->abrv;
		$data['unit'] = $this->unit;
		$data['abrv'] = $this->abrv;
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
}
