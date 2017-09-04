<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->unit = '聯絡資訊管理';
		$this->abrv = 'contact_';
		$this->load->model('Contact_model', 'models');

		// haveField 為必填欄位，saveField 為所有要儲存的欄位
		$this->saveField = array(
			'contact_mail' => array('dataType'=>'string', 'name'=>'意見信箱'),
			'contact_telephone'=> array('dataType'=>'string', 'name'=>'聯絡電話'),
			'contact_fax'=> array('dataType'=>'string', 'name'=>'傳真號碼'),
			'contact_address_zh_TW' => array('dataType'=>'string', 'name'=>'聯絡地址'),
			'contact_address_en_US' => array('dataType'=>'string', 'name'=>'聯絡地址-英'),
		);
		$this->haveField = array('contact_mail', 'contact_telephone', 'contact_fax', 'contact_address_zh_TW');
		$this->contactId = 1;
	}


	public function index(){

		$id = $this->contactId;

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
			$updateData = $this->postFieldChekck($this->saveField, $this->haveField, [], $HTTP_REFERER);
			$updateData['contact_id'] = '1';
			$status = $this->models->updateData($updateData);
			if($status){
				$alerts[$this->config->item('alertSuccess')] = $this->config->item('alertUpdateSuccess');
				$this->showAlerts($alerts);
				redirect('/'.$this->controllerName.'/');
			}else{
				$alerts[$this->config->item('alertWarning')] = $this->config->item('alertDBError');
				$this->showAlerts($alerts);
				redirect('/'.$this->controllerName.'/');
			}
		}

		$data['head']['title'] = $this->unit;
		$data['sidebar']['active'] = $this->controllerName;
		$data['unit'] = $this->unit;
		$data['abrv'] = $this->abrv;
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView($this->controllerName.'/index', $data);
	}

}
