<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hearings extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '聽證程序';
		$this->abrv = 'hearing_';
		$this->load->model('Hearings_model', 'models');
		$this->load->model('HearingsNote_model', 'noteModels');

		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			$this->abrv.'title' => array('dataType'=>'string', 'name'=>'標題'),
			$this->abrv.'orig_filename'=> array('dataType'=>'string', 'name'=>'封面圖片檔名'),
			$this->abrv.'filename'=> array('dataType'=>'string', 'name'=>'封面圖片檔名'),
			$this->abrv.'status'=> array('dataType'=>'integer', 'name'=>'顯示狀態'),
			$this->abrv.'note_date'=> array('dataType'=>'array', 'name'=>'記事日期'),
			$this->abrv.'note_title'=> array('dataType'=>'array', 'name'=>'記事標題'),
			$this->abrv.'note_hyperlinks'=> array('dataType'=>'array', 'name'=>'連結'),
			$this->abrv.'note_content'=> array('dataType'=>'array', 'name'=>'記事內文'),
			$this->abrv.'note_id'=> array('dataType'=>'array', 'name'=>'流水號'),
			$this->abrv.'id'=> array('dataType'=>'integer', 'name'=>'流水號'),
			$this->abrv.'meta_description' => array('dataType'=>'string', 'name'=>'分享說明'),
		);
		$this->haveField = array($this->abrv.'title', $this->abrv.'status');

		$this->uploadFolder = $this->config->item('uploadPath');
		$this->tmpPath = $this->config->item('tmpPath');
		$this->uploadPath = $this->config->item('hearingPath');
		$this->deletePath = $this->config->item('deletePath');
		$this->cropSizeList = $this->config->item('defultCropSize');
	}


	public function index(){
		$data = [];
		$data['head']['includeCss'] = 'datatables';
		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['frontEndUrl'] = 'hearings';
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
			$dataList = $this->input->post();

			if(isset($dataList['tmp_img_file_url']) && $dataList['tmp_img_file_url'] !=''){
				$dataList[$this->abrv.'orig_filename'] = $dataList['tmp_img_filename'];
				$dataList[$this->abrv.'filename'] = $dataList['tmp_img_file_url'];

				// 移動封面圖片
				foreach($this->cropSizeList as $size){

					$tmpPath = $this->uploadFolder.$this->tmpPath.$size['path'].$dataList[$this->abrv.'filename'];
					$filePath = $this->uploadFolder.$this->uploadPath.$size['path'].$dataList[$this->abrv.'filename'];
					$this->moveFile($tmpPath, $filePath);
				}
			}

			// 儲存資料組成&檢查必填欄位
			$addData = $this->postFieldChekck($this->saveField, $this->haveField, $dataList);
			unset($addData[$this->abrv.'note_date'],$addData[$this->abrv.'note_title'],$addData[$this->abrv.'note_hyperlinks'],$addData[$this->abrv.'note_content']);

			$id = $this->models->addData($addData);
			if($id){

				$note_date = $this->input->post($this->abrv.'note_date', true);
				$note_title = $this->input->post($this->abrv.'note_title', true);
				$note_hyperlinks = $this->input->post($this->abrv.'note_hyperlinks');
				$note_content = $this->input->post($this->abrv.'note_content');

				//儲存記事
				foreach($note_title as $i=>$title){
					$addnote[$this->abrv.'id'] = $id;
					$addnote[$this->abrv.'note_date'] = isset($note_date[$i]) ? $note_date[$i] : '';
					$addnote[$this->abrv.'note_title'] = isset($title) ? $title : '';
					$addnote[$this->abrv.'note_hyperlinks'] = isset($title) ? $note_hyperlinks[$i] : '';
					$addnote[$this->abrv.'note_content'] = isset($note_content[$i]) ? $note_content[$i] : '';
					$this->noteModels->addData($addnote);
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
		$data['resultNote'] = $this->noteModels->getList(array($this->abrv.'id'=>$id), [0,0]);

		$op = $this->input->post('op', true);
		if( $op === 'upd' ){

			$HTTP_REFERER = $this->input->post('HTTP_REFERER', true);
			$dataList = $this->input->post();

			$saveField = $this->saveField;
			$haveField = $this->haveField;
			$haveField[] = $this->abrv.'id';
			$dataList[$this->abrv.'id'] = $data['result'][$this->abrv.'id'];

			if(isset($dataList['tmp_img_file_url']) && $dataList['tmp_img_file_url'] !=''){
				$dataList[$this->abrv.'orig_filename'] = $dataList['tmp_img_filename'];
				$dataList[$this->abrv.'filename'] = $dataList['tmp_img_file_url'];

				// 移動封面圖片
				foreach($this->cropSizeList as $size){

					$tmpPath = $this->uploadFolder.$this->tmpPath.$size['path'].$dataList[$this->abrv.'filename'];
					$filePath = $this->uploadFolder.$this->uploadPath.$size['path'].$dataList[$this->abrv.'filename'];
					$this->moveFile($tmpPath, $filePath);
				}
			}

			// 儲存資料組成&檢查必填欄位
			$updateData = $this->postFieldChekck($saveField, $haveField, $dataList);
			unset($updateData[$this->abrv.'note_date'],$updateData[$this->abrv.'note_title'],$updateData[$this->abrv.'note_content'],$updateData[$this->abrv.'note_id'],$updateData[$this->abrv.'note_hyperlinks']);

			if($updateData[$this->abrv.'filename'] ==''){
				$updateData[$this->abrv.'orig_filename'] = null;
				$updateData[$this->abrv.'filename'] = null;
			}

			$status = $this->models->updateData($updateData);

			if($status){
				// 先刪除所有的檔案
				$this->noteModels->deleteDataList(array($this->abrv.'id' => $updateData[$this->abrv.'id']));

				$note_id = $this->input->post($this->abrv.'note_id', true);
				$note_date = $this->input->post($this->abrv.'note_date', true);
				$note_title = $this->input->post($this->abrv.'note_title', true);
				$note_hyperlinks = $this->input->post($this->abrv.'note_hyperlinks');
				$note_content = $this->input->post($this->abrv.'note_content');

				//儲存記事
				foreach($note_title as $i=>$title){
					$setData = [];
					$setData[$this->abrv.'id'] = $updateData[$this->abrv.'id'];
					$setData[$this->abrv.'note_date'] = isset($note_date[$i]) ? $note_date[$i] : '';
					$setData[$this->abrv.'note_title'] = isset($title) ? $title : '';
					$setData[$this->abrv.'note_hyperlinks'] = isset($title) ? $note_hyperlinks[$i] : '';
					$setData[$this->abrv.'note_content'] = isset($note_content[$i]) ? $note_content[$i] : '';
					$setData[$this->abrv.'note_is_del'] = 0;

					if(isset($note_id[$i]) && $note_id[$i] !=''){
						// 更新
						$setData[$this->abrv.'note_id'] = $note_id[$i];
						$status = $this->noteModels->updateData($setData);

					} else {
						//新增
						$status = $this->noteModels->addData($setData);
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
}
