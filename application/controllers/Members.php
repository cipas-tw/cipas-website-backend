<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '本會委員';
		$this->abrv = 'commissioner_';
		$this->load->model('Members_model', 'models');

		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			$this->abrv.'title' => array('dataType'=>'string', 'name'=>'標題'),
			$this->abrv.'orig_filename'=> array('dataType'=>'string', 'name'=>'封面圖片檔名'),
			$this->abrv.'filename'=> array('dataType'=>'string', 'name'=>'封面圖片檔名'),
			$this->abrv.'status'=> array('dataType'=>'integer', 'name'=>'顯示狀態'),
			$this->abrv.'name'=> array('dataType'=>'string', 'name'=>'委員姓名'),
			$this->abrv.'education'=> array('dataType'=>'array', 'name'=>'學歷'),
			$this->abrv.'experience'=> array('dataType'=>'array', 'name'=>'經歷'),
			$this->abrv.'is_leader'=> array('dataType'=>'string', 'name'=>'是否為主任委員'),
			$this->abrv.'id'=> array('dataType'=>'integer', 'name'=>'流水號'),
		);
		$this->haveField = array($this->abrv.'title', $this->abrv.'status');

		$this->uploadFolder = $this->config->item('uploadPath');
		$this->tmpPath = $this->config->item('tmpPath');
		$this->uploadPath = $this->config->item('commissionerPath');
		$this->deletePath = $this->config->item('deletePath');
		$this->cropSizeList = $this->config->item('commissionerCropSize');
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
		// $httpGetParams = $this->combineGetParams($queryData);
		// $pageConfig = $this->getPageConfig();
		// $pageConfig['base_url'] = __FUNCTION__.'?'.$httpGetParams;
		// $pageConfig['total_rows'] = $this->models->getList($queryData, []);
		// $this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->models->getList($queryData, array(0,0));
// echo "<pre>";print_r($data['result']);echo "</pre>";exit;
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

			if(isset($addData['tmp_img_file_url']) && $addData['tmp_img_file_url'] !=''){
				$addData[$this->abrv.'orig_filename'] = $addData['tmp_img_filename'];
				$addData[$this->abrv.'filename'] = $addData['tmp_img_file_url'];

				// 移動封面圖片
				foreach($this->cropSizeList as $size){

					$tmpPath = $this->uploadFolder.$this->tmpPath.$size['path'].$addData[$this->abrv.'filename'];
					$filePath = $this->uploadFolder.$this->uploadPath.$size['path'].$addData[$this->abrv.'filename'];
					$this->moveFile($tmpPath, $filePath);
				}
			}

			// 儲存資料組成&檢查必填欄位
			$addData = $this->postFieldChekck($saveField, $haveField, $dataList);

			$addData[$this->abrv.'education'] = json_encode($addData[$this->abrv.'education']);
			$addData[$this->abrv.'experience'] = json_encode($addData[$this->abrv.'experience']);

			$id = $this->models->addData($addData);

			if($id){
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
			$updateData[$this->abrv.'education'] = json_encode($updateData[$this->abrv.'education']);
			$updateData[$this->abrv.'experience'] = json_encode($updateData[$this->abrv.'experience']);

			if($updateData[$this->abrv.'filename'] ==''){
				$updateData[$this->abrv.'orig_filename'] = null;
				$updateData[$this->abrv.'filename'] = null;
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

		$data['imagePath'] = $this->uploadFolder.$this->uploadPath.$this->cropSizeList[1]['path'];
		$data['result'][$this->abrv.'education'] = json_decode($data['result'][$this->abrv.'education']);
		$data['result'][$this->abrv.'experience'] = json_decode($data['result'][$this->abrv.'experience']);
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

	public function sortAjax($op, $id, $sort){
		if( $op === 'sort' ){
			$HTTP_REFERER = $_SERVER['HTTP_REFERER'];
			$updateData[$this->abrv.'id'] = $id;
			$updateData[$this->abrv.'sort'] = $sort;
			$this->models->updateData($updateData);
		}
	}
}
