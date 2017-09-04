<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collect extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '史料徵集說明';
		$this->abrv = 'collect_plan_';
		$this->load->model('Collect_model', 'models');
		$this->load->model('CollectFile_model', 'fileModels');

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
		$this->uploadPath = $this->config->item('collectPlanPath');
		$this->deletePath = $this->config->item('deletePath');

		$this->collectPlanExplainId = 1;
	}


	public function index(){

		$id = $this->collectPlanExplainId;

		// 資料檢查
		$data = [];
		$data['frontEndUrl'] = 'collect';
		$data['result'] = $this->models->getData($id);
		if($id =='' || !isset($data['result'])){
			$alerts[$this->config->item('alertDanger')] = '查無此資料，請重新進入編輯頁面';
			$this->showAlerts($alerts);
			redirect('/');
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
				redirect($this->controllerName.'/');
			}else{
				$alerts[$this->config->item('alertWarning')] = $this->config->item('alertDBError');
				$this->showAlerts($alerts);
				redirect($this->controllerName.'/');
			}
		}

		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['template']['abrv'] = $this->abrv;
		$data['unit'] = $this->unit;
		$data['abrv'] = $this->abrv;
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$data['block']['prevPage'] = base_url('/'.$this->controllerName.'/');
		$this->showView($this->controllerName.'/index', $data);
	}
}
