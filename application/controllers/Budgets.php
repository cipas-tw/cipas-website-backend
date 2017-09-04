<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budgets extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '預算書及決算書';
		$this->abrv = 'budget_';
		$this->load->model('budgets_model', 'models');

		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			$this->abrv.'title' => array('dataType'=>'string', 'name'=>'標題'),
			$this->abrv.'orig_filename'=> array('dataType'=>'string', 'name'=>'附件檔名'),
			$this->abrv.'filename'=> array('dataType'=>'string', 'name'=>'附件檔名'),
			$this->abrv.'id'=> array('dataType'=>'integer', 'name'=>'流水號'),
		);
		$this->haveField = array($this->abrv.'title');

		$this->uploadFolder = $this->config->item('uploadPath');
		$this->tmpPath = $this->config->item('tmpPath');
		$this->uploadPath = $this->config->item('budgetPath');
		$this->deletePath = $this->config->item('deletePath');
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

		// 分頁
		$httpGetParams = $this->combineGetParams($queryData);
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = __FUNCTION__.'?'.$httpGetParams;
		$pageConfig['total_rows'] = $this->models->getList($queryData, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->models->getList($queryData, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$data['path'] = $this->uploadFolder.$this->uploadPath;
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView($this->controllerName.'/index', $data);
	}

	public function create(){
		$op = $this->input->post('op', true);
		if( $op === 'add' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);
			$dataList = $this->input->post();

			$saveField = $this->saveField;
			$haveField = $this->haveField;

			if(isset($dataList['tmp_file_url']) && $dataList['tmp_file_url'] !=''){
				$dataList[$this->abrv.'orig_filename'] = $dataList['tmp_filename'];
				$dataList[$this->abrv.'filename'] = $dataList['tmp_file_url'];

				$tmpPath = $this->uploadFolder.$this->tmpPath.$dataList[$this->abrv.'filename'];
				$filePath = $this->uploadFolder.$this->uploadPath.$dataList[$this->abrv.'filename'];
				$this->moveFile($tmpPath, $filePath);
			}

			// 儲存資料組成&檢查必填欄位
			$addData = $this->postFieldChekck($saveField, $haveField, $dataList);

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

			if(isset($dataList['tmp_file_url']) && $dataList['tmp_file_url'] !=''){
				$dataList[$this->abrv.'orig_filename'] = $dataList['tmp_filename'];
				$dataList[$this->abrv.'filename'] = $dataList['tmp_file_url'];

				$tmpPath = $this->uploadFolder.$this->tmpPath.$dataList[$this->abrv.'filename'];
				$filePath = $this->uploadFolder.$this->uploadPath.$dataList[$this->abrv.'filename'];
				$this->moveFile($tmpPath, $filePath);
			}

			// 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($saveField, $haveField, $dataList);

			//將刪除的資料轉至刪除資料夾
			/*if(){}*/
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
