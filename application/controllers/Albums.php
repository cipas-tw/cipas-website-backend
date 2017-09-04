<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '圖集管理';
		$this->abrv = 'photo_';
		$this->load->model('Albums_model', 'models');
		$this->load->model('AlbumsFile_model', 'fileModels');

		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			$this->abrv.'title' => array('dataType'=>'string', 'name'=>'標題'),
			$this->abrv.'file_id'=> array('dataType'=>'array', 'name'=>'流水號'),
			$this->abrv.'id'=> array('dataType'=>'integer', 'name'=>'流水號'),
		);
		$this->haveField = array($this->abrv.'title');

		$this->uploadFolder = $this->config->item('uploadPath');
		$this->tmpPath = $this->config->item('tmpPath');
		$this->uploadPath = $this->config->item('photoPath');
		$this->deletePath = $this->config->item('deletePath');
		$this->cropSizeList = $this->config->item('sliderCropSize');
		$this->uploadUrl = $this->config->item('uploadUrl');
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
		$result = $this->models->getList($queryData, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));

		// 整理資料
		$fileQueryData = [];
		foreach($result as $val){
			$data['result'][$val[$this->abrv.'id']] = $val;
			$fileQueryData[$this->abrv.'id'][] = $val[$this->abrv.'id'];
		}
		$fileData = $this->fileModels->getList($fileQueryData, [0,0]);
		foreach($fileData as $val){
			if(isset($data['result'][$val[$this->abrv.'id']])){
				$data['result'][$val[$this->abrv.'id']]['img'][] = $val['photo_file_name'];
			}
		}

		$data['status'] = $this->config->item('status');
		$data['imagePath'] = $this->uploadFolder.$this->uploadPath.$this->cropSizeList[1]['path'];
		$data['uploadUrl'] = $this->uploadUrl.$this->uploadPath.$this->cropSizeList[0]['path'];
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

			unset($addData[$this->abrv.'file_title']);

			$id = $this->models->addData($addData);
			if($id){
				$tmp_filename = $this->input->post('tmp_filename', true);
				$tmp_file_url = $this->input->post('tmp_file_url', true);

				//儲存檔案
				foreach($tmp_file_url as $i=>$fileUrl){
					if(isset($fileUrl) && $fileUrl !=''){

						$addFile[$this->abrv.'id'] = $id;
						$addFile[$this->abrv.'file_orig_name'] = isset($tmp_filename[$i]) ? $tmp_filename[$i] : '';
						$addFile[$this->abrv.'file_name'] = $tmp_file_url[$i];

						// 移動縮圖
						foreach($this->cropSizeList as $size){

							$tmpPath = $this->uploadFolder.$this->tmpPath.$size['path'].$addFile[$this->abrv.'file_name'];
							$filePath = $this->uploadFolder.$this->uploadPath.$size['path'].$addFile[$this->abrv.'file_name'];
							$this->moveFile($tmpPath, $filePath);
						}
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
			$status = $this->models->updateData($updateData);

			if($status){
				$tmp_filename = $this->input->post('tmp_filename', true);
				$tmp_file_url = $this->input->post('tmp_file_url', true);

				//儲存檔案
				foreach($tmp_filename as $i=>$filename){
					$setData = [];
					$setData[$this->abrv.'id'] = $dataList[$this->abrv.'id'];
					$setData[$this->abrv.'file_is_del'] = 0;

					if(isset($tmp_file_url[$i]) && $tmp_file_url[$i]!=''){
						$setData[$this->abrv.'file_orig_name'] = $filename;
						$setData[$this->abrv.'file_name'] = $tmp_file_url[$i];

						// 移動縮圖
						foreach($this->cropSizeList as $size){

							$tmpPath = $this->uploadFolder.$this->tmpPath.$size['path'].$setData[$this->abrv.'file_name'];
							$filePath = $this->uploadFolder.$this->uploadPath.$size['path'].$setData[$this->abrv.'file_name'];

							$this->moveFile($tmpPath, $filePath);
						}
						$tmpPath = $this->uploadFolder.$this->tmpPath.$setData[$this->abrv.'file_name'];
						$filePath = $this->uploadFolder.$this->uploadPath.$setData[$this->abrv.'file_name'];

						$this->moveFile($tmpPath, $filePath);

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
		$data['unit'] = $this->unit;
		$data['abrv'] = $this->abrv;
		$data['imagePath'] = $this->uploadFolder.$this->uploadPath.$this->cropSizeList[1]['path'];
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

	public function deleteDetailAction(){
		$op = $this->input->post('op', true);
		if( $op === 'del' ){
			$deleteData[$this->abrv.'file_id'] = trim($this->input->post('id', true));
			$HTTP_REFERER = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
			$this->fileModels->deleteData($deleteData);

			$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertDeleteSuccess');
			$this->showAlerts($alerts);
			redirect($HTTP_REFERER);
		}
	}
}
