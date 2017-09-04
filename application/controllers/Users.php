<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '使用者管理';
		$this->abrv = 'users_';
		$this->load->model('users_model', 'models');
		$this->load->model('Permissions_model', 'Permission_model');

		$this->saveField = array(
			$this->abrv.'account' => array('dataType'=>'string', 'name'=>'帳號'),
			$this->abrv.'name'=> array('dataType'=>'string', 'name'=>'姓名'),
			$this->abrv.'email'=> array('dataType'=>'string', 'name'=>'信箱'),
			$this->abrv.'password'=> array('dataType'=>'string', 'name'=>'密碼'),
			'backend_menu_permission_id'=> array('dataType'=>'integer', 'name'=>'權限'),
			$this->abrv.'id'=> array('dataType'=>'integer', 'name'=>'流水號'),
		);
		$this->haveField = array($this->abrv.'title', $this->abrv.'show_date', $this->abrv.'content', $this->abrv.'status');
	}


	public function index(){
		$data = [];
		$data['head']['includeCss'] = 'datatables';
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = 'users';
		$data['abrv'] = $this->abrv;
		$data['unit'] = $this->unit;
		$queryData['keyword'] = trim($this->input->get('keyword', true));
		$httpGetParams = $this->combineGetParams($queryData);
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = __FUNCTION__.'?'.$httpGetParams;
		$pageConfig['total_rows'] = $this->models->getList($queryData, []);
		$this->pagination->initialize($pageConfig);
		$data['result'] = $this->models->getList($queryData, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$this->showView($this->controllerName.'/index', $data);
	}

	public function create(){
		$op = $this->input->post('op', true);
		if( $op === 'add' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);

			// 儲存資料組成&檢查必填欄位
			$addData = $this->postFieldChekck($this->saveField, $this->haveField);

			$addData[$this->abrv.'password'] = $this->sha256Encode($addData[$this->abrv.'password']);
			$status = $this->models->addData($addData);
			if($status){
				$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertAddSuccess');
				$this->showAlerts($alerts);
				redirect($HTTP_REFERER);
			}else{
				$alerts[$this->config->item('alertDanger')] = '此帳號已重複';
				$this->showAlerts($alerts);
				redirect($_SERVER['HTTP_REFERER']);
			}
		}

		$data = [];
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = 'users';
		$data['permissionList'] = $this->Permission_model->getList(false, [0,0]);
		$data['unit'] = $this->unit;
		$data['abrv'] = $this->abrv;
		$data['unit'] = $this->unit;
		$this->showView($this->controllerName.'/'.__FUNCTION__, $data);
	}

	public function edit($id){

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

			$this->haveField[] = $this->abrv.'id';
			$dataList[$this->abrv.'id'] = $data['result'][$this->abrv.'id'];

			// 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($this->saveField, $this->haveField, $dataList);
			if( $updateData[$this->abrv.'password'] === '' ){
				unset($updateData[$this->abrv.'password']);
			}else{
				$updateData[$this->abrv.'password'] = $this->sha256Encode($updateData[$this->abrv.'password']);
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
		$data['sidebar']['active'] = 'users';
		$data['permissionList'] = $this->Permission_model->getList(false, [0,0]);
		$data['unit'] = $this->unit;
		$data['abrv'] = $this->abrv;

		$this->showView($this->controllerName.'/'.__FUNCTION__, $data);
	}

	public function deleteAction(){
		$op = $this->input->post('op', true);
		if( $op === 'del' ){
			$deleteData[$this->abrv.'id'] = trim($this->input->post('id', true));
			$HTTP_REFERER = $_SERVER['HTTP_REFERER'];
			$this->models->deleteData($deleteData);
			redirect($HTTP_REFERER);
		}
	}
}
