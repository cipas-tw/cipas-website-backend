<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regulations extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '主管法規條文';
		$this->abrv = 'law_';
		$this->load->model('Regulations_model', 'models');
		$this->load->model('RegulationsChapter_model', 'chapterModels');
		$this->load->model('RegulationsTerms_model', 'termsModels');
		$this->load->model('RegulationsFile_model', 'fileModels');

		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			$this->abrv.'title' => array('dataType'=>'string', 'name'=>'標題'),
			$this->abrv.'content'=> array('dataType'=>'string', 'name'=>'內文'),
			$this->abrv.'status'=> array('dataType'=>'string', 'name'=>'狀態'),
			$this->abrv.'file_title'=> array('dataType'=>'array', 'name'=>'上傳附件'),
			$this->abrv.'file_id'=> array('dataType'=>'array', 'name'=>'流水號'),
			$this->abrv.'meta_description' => array('dataType'=>'string', 'name'=>'分享說明'),
			$this->abrv.'sort' => array('dataType'=>'integer', 'name'=>'排序'),
		);
		$this->haveField = array($this->abrv.'title', $this->abrv.'content');

		$this->uploadFolder = $this->config->item('uploadPath');
		$this->tmpPath = $this->config->item('tmpPath');
		$this->uploadPath = $this->config->item('lawPath');
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
		$data['status'] = $this->config->item('status');
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView($this->controllerName.'/main/index', $data);
	}

	public function addMainForm(){
		$data = [];
		$data['head']['includeCss'] = 'datatables';
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['abrv'] = $this->abrv;
		$data['unit'] = $this->unit;

		$op = $this->input->post('op', true);
		if( $op === 'add' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);

			// 儲存資料組成&檢查必填欄位
			$addData = $this->postFieldChekck($this->saveField, $this->haveField);
			$file_title = isset($addData[$this->abrv.'file_title']) ? $addData[$this->abrv.'file_title'] : array();

			unset($addData[$this->abrv.'file_title']);

			$id = $this->models->addData($addData);

			if($id){
				$tmp_filename = $this->input->post('tmp_filename', true);
				$tmp_file_url = $this->input->post('tmp_file_url', true);

				//儲存檔案
				foreach($tmp_file_url as $i=>$fileUrl){
					if(isset($fileUrl) && $fileUrl !=''){
						$addFile[$this->abrv.'id'] = $id;
						$addFile[$this->abrv.'file_title'] = $file_title[$i];
						$addFile[$this->abrv.'file_orig_name'] = isset($tmp_filename[$i]) ? $tmp_filename[$i] : '';
						$addFile[$this->abrv.'file_name'] = $fileUrl;

						$tmpPath = $this->uploadFolder.$this->tmpPath.$addFile[$this->abrv.'file_name'];
						$filePath = $this->uploadFolder.$this->uploadPath.$addFile[$this->abrv.'file_name'];

						$this->moveFile($tmpPath, $filePath);

						$this->fileModels->addData($addFile);
					}
				}
				$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertAddSuccess');
				$this->showAlerts($alerts, $HTTP_REFERER);
			}else{
				$alerts[$this->config->item('alertWarning')] = $this->config->item('alertDBError');
				$this->showAlerts($alerts, $_SERVER['HTTP_REFERER']);
			}
		}

		$data['template']['abrv'] = $this->abrv;
		$data['status'] = $this->config->item('status');
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$data['template']['view'] = $this->controllerName.'/main/template';
		$this->showView($this->controllerName.'/main/create', $data);
	}

	public function detail($id=''){
		$data = [];
		$data['head']['includeCss'] = 'datatables';
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['abrv'] = $this->abrv;
		$data['unit'] = $this->unit;

		// 分頁
		$queryData[$this->abrv.'id'] = $id;
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = '?';
		$pageConfig['total_rows'] = $this->chapterModels->getList($queryData, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->models->getData($id);
		$data['chapterList'] = $this->chapterModels->getList($queryData, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$data['resultFile'] = $this->fileModels->getList(array($this->abrv.'id'=>$id), [0,0]);

		if($id =='' || !isset($data['result'])){
			$alerts[$this->config->item('alertDanger')] = '查無此資料，請重新進入編輯頁面';
			$this->showAlerts($alerts);
			redirect('/'.$this->controllerName.'/');
		}

		$op = $this->input->post('op', true);
		if( $op === 'upd' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);
			$dataList = $this->input->post();

			$saveField = $this->saveField;
			$haveField = $this->haveField;
			$haveField[] = $this->abrv.'id';
			$dataList[$this->abrv.'id'] = $data['result'][$this->abrv.'id'];

			// 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($this->saveField, $this->haveField);
			$updateData[$this->abrv.'id'] = $id;

			$file_title = isset($dataList[$this->abrv.'file_title']) ? $dataList[$this->abrv.'file_title'] : array();
			$file_id = isset($dataList[$this->abrv.'file_id'])? $dataList[$this->abrv.'file_id'] : array();
			unset($updateData[$this->abrv.'file_title'], $updateData[$this->abrv.'file_name'], $updateData[$this->abrv.'file_id']);

			$status = $this->models->updateData($updateData);

			if($status){
				// 先刪除所有的檔案
				$this->fileModels->deleteDataList(array($this->abrv.'id' => $dataList[$this->abrv.'id']));

				$tmp_filename = $this->input->post('tmp_filename', true);
				$tmp_file_url = $this->input->post('tmp_file_url', true);

				//儲存檔案
				foreach($file_title as $i=>$title){
					$setData = [];
					$setData[$this->abrv.'id'] = $dataList[$this->abrv.'id'];
					$setData[$this->abrv.'file_title'] = $title;
					$setData[$this->abrv.'file_is_del'] = 0;

					if(isset($tmp_file_url[$i]) && $tmp_file_url[$i]!=''){
						$setData[$this->abrv.'file_orig_name'] = isset($tmp_filename[$i]) ? $tmp_filename[$i] : '';
						$setData[$this->abrv.'file_name'] = $tmp_file_url[$i];

						$tmpPath = $this->uploadFolder.$this->tmpPath.$setData[$this->abrv.'file_name'];
						$filePath = $this->uploadFolder.$this->uploadPath.$setData[$this->abrv.'file_name'];

						$this->moveFile($tmpPath, $filePath);
					}

					if(isset($file_id[$i]) && $file_id[$i] !=''){
						// 更新
						$setData[$this->abrv.'file_id'] = $file_id[$i];
						$status = $this->fileModels->updateData($setData);

					} else {
						//新增
						$status = $this->fileModels->addData($setData);
					}
				}

				$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertUpdateSuccess');
			}else{
				$alerts[$this->config->item('alertWarning')] = $this->config->item('alertDBError');
			}
			$this->showAlerts($alerts, $this->controllerName);
		}

		$data['id'] = $id;
		$data['template']['abrv'] = $this->abrv;
		$data['status'] = $this->config->item('status');
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$data['template']['view'] = $this->controllerName.'/main/template';
		$this->showView($this->controllerName.'/detail/index', $data);
	}

	public function create($id){


		$op = $this->input->post('op', true);
		if( $op === 'add' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);

			$this->saveField = array(
				$this->abrv.'chapter_title' => array('dataType'=>'string', 'name'=>'標題'),
				$this->abrv.'chapter_sort' => array('dataType'=>'string', 'name'=>'排序'),
				$this->abrv.'terms_content'=> array('dataType'=>'array', 'name'=>'條文'),
				$this->abrv.'terms_numbering'=> array('dataType'=>'array', 'name'=>'內文'),
				$this->abrv.'terms_sort'=> array('dataType'=>'array', 'name'=>'排序'),
			);
			$this->haveField = $this->saveField;
			// 儲存資料組成&檢查必填欄位
			$addData = $this->postFieldChekck($this->saveField, $this->haveField);
			$terms_numbering = $addData[$this->abrv.'terms_numbering'];
			$terms_content = $addData[$this->abrv.'terms_content'];
			$terms_sort = $addData[$this->abrv.'terms_sort'];
			unset($addData[$this->abrv.'terms_content'], $addData[$this->abrv.'terms_sort'], $addData[$this->abrv.'terms_numbering']);
			$addData[$this->abrv.'id'] = $id;

			$id = $this->chapterModels->addData($addData);
			if($id){
				//儲存檔案
				foreach($terms_content as $i=>$content){
					if(isset($content) && $content !=''){
						$addFile[$this->abrv.'chapter_id'] = $id;
						$addFile[$this->abrv.'terms_numbering'] = $terms_numbering[$i]; 
						$addFile[$this->abrv.'terms_content'] = $content;
						$addFile[$this->abrv.'terms_sort'] = $terms_sort[$i];

						$this->termsModels->addData($addFile);
					}
				}
				$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertAddSuccess');
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

		$this->showView($this->controllerName.'/detail/'.__FUNCTION__, $data);

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
				$this->abrv.'chapter_sort' => array('dataType'=>'string', 'name'=>'排序'),
				$this->abrv.'terms_sort'=> array('dataType'=>'array', 'name'=>'條文編號'),
				$this->abrv.'terms_numbering'=> array('dataType'=>'array', 'name'=>'內文'),
				$this->abrv.'terms_content'=> array('dataType'=>'array', 'name'=>'內文'),
				$this->abrv.'terms_id'=> array('dataType'=>'array', 'name'=>'流水號'),
			);
			$this->haveField = $this->saveField;
			$dataList[$this->abrv.'chapter_id'] = $data['result'][$this->abrv.'chapter_id'];

			// 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($this->saveField, $this->haveField, $dataList);
			$terms_numbering = $updateData[$this->abrv.'terms_numbering'];
			$terms_content = $updateData[$this->abrv.'terms_content'];
			$terms_sort = $updateData[$this->abrv.'terms_sort'];
			$terms_id = isset($updateData[$this->abrv.'terms_id'])? $updateData[$this->abrv.'terms_id'] : array();
			unset($updateData[$this->abrv.'terms_content'], $updateData[$this->abrv.'terms_sort'], $updateData[$this->abrv.'terms_id'], $updateData[$this->abrv.'terms_numbering']);

			$status = $this->chapterModels->updateData($updateData);

			if($status){
				// 先刪除所有的檔案
				$this->termsModels->deleteDataList(array($this->abrv.'chapter_id' => $updateData[$this->abrv.'chapter_id']));

				//儲存檔案
				foreach($terms_content as $i=>$content){
					$setData = [];
					$setData[$this->abrv.'chapter_id'] = $updateData[$this->abrv.'chapter_id'];
					$setData[$this->abrv.'terms_numbering'] = $terms_numbering[$i];
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
		$this->showView($this->controllerName.'/detail/'.__FUNCTION__, $data);
	}

	public function deleteAction(){
		$op = $this->input->post('op', true);
		if( $op === 'del' ){
			$deleteData[$this->abrv.'id'] = trim($this->input->post('id', true));
			$HTTP_REFERER = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
			$this->models->deleteData($deleteData);

			$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertDeleteSuccess');
			$this->showAlerts($alerts, $HTTP_REFERER);
		}
	}

	public function deleteDetailAction(){
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
