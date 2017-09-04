<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recoveries extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '已回復權利事項';
		$this->abrv = 'repo_';
		$this->load->model('Recoveries_model', 'models');
		$this->load->model('RecoveriesFile_model', 'fileModels');

		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			$this->abrv.'title' => array('dataType'=>'string', 'name'=>'標題'),
			$this->abrv.'show_date'=> array('dataType'=>'string', 'name'=>'發佈日期'),
			$this->abrv.'content'=> array('dataType'=>'string', 'name'=>'內文'),
			$this->abrv.'status'=> array('dataType'=>'integer', 'name'=>'顯示狀態'),
			$this->abrv.'file_title'=> array('dataType'=>'array', 'name'=>'上傳附件'),
			$this->abrv.'file_id'=> array('dataType'=>'array', 'name'=>'流水號'),
			$this->abrv.'id'=> array('dataType'=>'integer', 'name'=>'流水號'),
			$this->abrv.'meta_description' => array('dataType'=>'string', 'name'=>'分享說明'),
		);
		$this->haveField = array($this->abrv.'title', $this->abrv.'show_date', $this->abrv.'content', $this->abrv.'status');

		$this->uploadFolder = $this->config->item('uploadPath');
		$this->tmpPath = $this->config->item('tmpPath');
		$this->uploadPath = $this->config->item('repossessPath');
		$this->deletePath = $this->config->item('deletePath');
	}


	public function index(){
		$data = [];
		$data['head']['includeCss'] = 'datatables';
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['frontEndUrl'] = 'recoveries';
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
		$this->showView($this->controllerName.'/index', $data);
	}

	public function create(){
		$op = $this->input->post('op', true);
		if( $op === 'add' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);

			$saveField = $this->saveField;
			$haveField = $this->haveField;

			// 儲存資料組成&檢查必填欄位
			$addData = $this->postFieldChekck($saveField, $haveField);
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
		$data['resultFile'] = $this->fileModels->getList(array($this->abrv.'id'=>$id), [0,0]);

		$op = $this->input->post('op', true);
		if( $op === 'upd' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);
			$dataList = $this->input->post();

			$saveField = $this->saveField;
			$haveField = $this->haveField;
			$haveField[] = $this->abrv.'id';
			$dataList[$this->abrv.'id'] = $data['result'][$this->abrv.'id'];

			// 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($saveField, $haveField, $dataList);

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
