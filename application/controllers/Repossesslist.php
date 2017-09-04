<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Repossesslist extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '回復權利說明';
		$this->abrv = 'repo_list_';
		$this->load->model('RepossessList_model', 'models');
		$this->load->model('RepossessListChapter_model', 'chapterModels');
		$this->load->model('RepossessListTerms_model', 'termsModels');

		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			$this->abrv.'title' => array('dataType'=>'string', 'name'=>'標題'),
			$this->abrv.'content'=> array('dataType'=>'string', 'name'=>'內文'),
		);
		$this->haveField = array($this->abrv.'title', $this->abrv.'content');

		$this->repossessId = 1;
	}


	public function index(){
		$data = [];
		$data['head']['includeCss'] = 'datatables';
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['abrv'] = $this->abrv;
		$data['unit'] = $this->unit;

		$op = $this->input->post('op', true);
		if( $op === 'upd' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);

			// 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($this->saveField, $this->haveField);

			$updateData[$this->abrv.'id'] = $this->repossessId;
			$status = $this->models->updateData($updateData);

			if($status){
				$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertUpdateSuccess');
				$this->showAlerts($alerts, '/'.$this->controllerName.'/');
			}else{
				$alerts[$this->config->item('alertWarning')] = $this->config->item('alertDBError');
				$this->showAlerts($alerts, '/'.$this->controllerName.'/');
			}
		}


		// 分頁
		$queryData[$this->abrv.'id'] = $this->repossessId;
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = __FUNCTION__.'?';
		$pageConfig['total_rows'] = $this->chapterModels->getList([], []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->models->getData($this->repossessId);
		$data['chapterList'] = $this->chapterModels->getList([], array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));

		$data['status'] = $this->config->item('status');
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$data['block']['prevPage'] = base_url('/'.$this->controllerName.'/');
		$data['frontEndUrl'] = 'recoveries';
		$this->showView($this->controllerName.'/index', $data);
	}

	public function create(){
		$op = $this->input->post('op', true);
		if( $op === 'add' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);

			$this->saveField = array(
				$this->abrv.'chapter_title' => array('dataType'=>'string', 'name'=>'標題'),
				$this->abrv.'terms_content'=> array('dataType'=>'array', 'name'=>'內文'),
				$this->abrv.'terms_sort'=> array('dataType'=>'array', 'name'=>'排序'),
			);
			$this->haveField = $this->saveField;

			// 儲存資料組成&檢查必填欄位
			$addData = $this->postFieldChekck($this->saveField, $this->haveField);
			$terms_content = $addData[$this->abrv.'terms_content'];
			$terms_sort = $addData[$this->abrv.'terms_sort'];
			unset($addData[$this->abrv.'terms_content'], $addData[$this->abrv.'terms_sort']);

			$addData[$this->abrv.'id'] = $this->repossessId;

			$id = $this->chapterModels->addData($addData);

			if($id){

				//儲存檔案
				foreach($terms_content as $i=>$content){
					if(isset($content) && $content !=''){
						$addFile[$this->abrv.'chapter_id'] = $id;
						$addFile[$this->abrv.'terms_content'] = $content;
						$addFile[$this->abrv.'terms_sort'] = $terms_sort[$i];

						$this->termsModels->addData($addFile);
					}
				}

				$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertUpdateSuccess');
				$this->showAlerts($alerts, $HTTP_REFERER);
			}else{
				$alerts[$this->config->item('alertWarning')] = $this->config->item('alertDBError');
				$this->showAlerts($alerts, $_SERVER['HTTP_REFERER']);
			}
		}

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
		$data['result'] = $this->chapterModels->getData($id);
		if($id =='' || !isset($data['result'])){
			$alerts[$this->config->item('alertDanger')] = '查無此資料，請重新進入編輯頁面';
			$this->showAlerts($alerts);
			redirect('/'.$this->controllerName.'/');
		}
		$data['resultTerms'] = $this->termsModels->getList(array($this->abrv.'chapter_id'=>$id), [0,0]);

		$op = $this->input->post('op', true);
		if( $op === 'upd' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);
			$dataList = $this->input->post();

			$this->saveField = array(
				$this->abrv.'chapter_id'=> array('dataType'=>'integer', 'name'=>'流水號'),
				$this->abrv.'chapter_title' => array('dataType'=>'string', 'name'=>'標題'),
				$this->abrv.'terms_sort'=> array('dataType'=>'array', 'name'=>'排序'),
				$this->abrv.'terms_content'=> array('dataType'=>'array', 'name'=>'內文'),
				$this->abrv.'terms_id'=> array('dataType'=>'array', 'name'=>'流水號'),
			);
			$this->haveField = $this->saveField;
			$dataList[$this->abrv.'chapter_id'] = $data['result'][$this->abrv.'chapter_id'];

			// 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($this->saveField, $this->haveField, $dataList);
			$terms_content = $updateData[$this->abrv.'terms_content'];
			$terms_sort = $updateData[$this->abrv.'terms_sort'];
			$terms_id = isset($updateData[$this->abrv.'terms_id'])? $updateData[$this->abrv.'terms_id'] : array();

			unset($updateData[$this->abrv.'terms_content'], $updateData[$this->abrv.'terms_sort'], $updateData[$this->abrv.'terms_id']);

			$status = $this->chapterModels->updateData($updateData);

			if($status){
				// 先刪除所有的檔案
				$this->termsModels->deleteDataList(array($this->abrv.'chapter_id' => $updateData[$this->abrv.'chapter_id']));

				//儲存檔案
				foreach($terms_content as $i=>$content){
					$setData = [];
					$setData[$this->abrv.'chapter_id'] = $updateData[$this->abrv.'chapter_id'];
					$setData[$this->abrv.'terms_content'] = $content;
					$setData[$this->abrv.'terms_sort'] = $terms_sort[$i];
					$setData[$this->abrv.'terms_is_del'] = 0;

					if(isset($terms_id[$i]) && $terms_id[$i] !=''){
						// 更新
						$setData[$this->abrv.'terms_id'] = $terms_id[$i];
						$status = $this->termsModels->updateData($setData);

					} else {
						//新增
						$status = $this->termsModels->addData($setData);
					}
				}

				$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertUpdateSuccess');
				$this->showAlerts($alerts, $HTTP_REFERER);
			}else{
				$alerts[$this->config->item('alertWarning')] = $this->config->item('alertDBError');
				$this->showAlerts($alerts, $_SERVER['HTTP_REFERER']);
			}
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
			$deleteData[$this->abrv.'chapter_id'] = trim($this->input->post('id', true));
			$HTTP_REFERER = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
			$this->chapterModels->deleteData($deleteData);

			$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertDeleteSuccess');
			$this->showAlerts($alerts, $HTTP_REFERER);
		}
	}
}
