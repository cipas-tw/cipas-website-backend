<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_BackendController extends CI_Controller {
	protected $controllerName;

	public function __construct(){
		parent::__construct();
		$this->controllerName = strtolower(get_class($this));
		$this->createKeyFile();

		unset($_POST['csrf_cipas']);

		
		if(!empty($_SERVER['REQUEST_URI'])){
			$this->urlParserStr($_SERVER['REQUEST_URI']);
		}

		foreach($_GET as $key => $val){
			$this->parserStr($key);
		}

		foreach($_POST as $key => $val){
			$this->parserStr($key);
		}

		foreach($_COOKIE as $key => $val){
			$this->parserStr($key);
		}

		if( isset($_GET['page']) ){
			if (!is_numeric($_GET['page'])){
				header('Location: http://www.cipas.gov.tw');exit;
			}
		}


		$this->permission = [];
		if( in_array($this->uri->segment(2), ['loginAction', 'forgetAction', 'logout']) ){
		}else{

			if( !$this->session->userdata('ubmsys_users_id') ){
				if( $this->uri->segment(2) !== 'login' ){
					redirect('home/login');
				}
			} else {
				if(!$this->uri->segment(1)){
					redirect('home/');
				}
				$this->load->model('SidebarMenu_model');
				$this->load->model('users_model');
				$sidebar = $this->SidebarMenu_model->getList();
				$userPermissionId = $this->users_model->getData($this->session->userdata('ubmsys_users_id'));
				$userPermissionLists = $this->users_model->getPermissionLists($userPermissionId['backend_menu_permission_id'])['backend_menu_permission_lists'];

				$this->sidebarMenu = $mainMenu = [];
				$permissionController = $this->config->item('sidebarPermissionController');
				foreach ($sidebar as $key => $value) {
					$firstField = 0;
					$secondField = 0;
					if($value['backend_menu_parent_id']==0){
						$firstField = $value['backend_menu_id'];
						$mainMenu[$value['backend_menu_id']] = $value;
						if(preg_match("/,".$firstField."[A-D],/i", $userPermissionLists) || $userPermissionLists=="all" || isset($this->sidebarMenu[$firstField]['subMenus'])){

							if(isset($this->sidebarMenu[$firstField]['mainMenus']['active'])){
								 $value['active'] = true;
							}
							$this->sidebarMenu[$firstField]['mainMenus'] = $value;
						}
						if($this->uri->segment(1) == $value['backend_menu_controller']){
							$this->sidebarMenu[$firstField]['mainMenus']['active'] = true;
						}
					}else{
						$firstField = $value['backend_menu_parent_id'];
						$secondField = $value['backend_menu_id'];
						if(preg_match("/,".$secondField."[A-D],/i", $userPermissionLists) || $userPermissionLists=="all"){
							if(!isset($this->sidebarMenu[$firstField]) && isset($mainMenu[$value['backend_menu_parent_id']])){
								$this->sidebarMenu[$firstField]['mainMenus'] = $mainMenu[$value['backend_menu_parent_id']];
							}
							$this->sidebarMenu[$firstField]['subMenus'][$secondField] = $value;
						}
						if($this->uri->segment(1) == $value['backend_menu_controller']){
							$this->sidebarMenu[$firstField]['mainMenus']['active'] = true;
							$this->sidebarMenu[$firstField]['subMenus'][$secondField]['active'] = true;
						}
					}

					// 新增修改刪除權限判斷
					if($this->uri->segment(1) == $value['backend_menu_controller']){

						if($userPermissionLists!="all" ){
							$permissiionPass = false;
							$uri_2 = $this->uri->segment(2) == '' ? 'index' : $this->uri->segment(2);

							$sidebarPermissionType = $this->config->item('sidebarPermissionType');
							$permissionKey = $permissionController[$uri_2];
							$permission = $value['backend_menu_id'].$permissionKey;

							if(preg_match("/,".$permission.",/i", $userPermissionLists) || $userPermissionLists=="all"){
								$permissiionPass = true;
							}
							if(( in_array($this->uri->segment(1), array('hotkeyword', 'historylink', 'repossesslist', 'rewardlist')) && $this->input->post() && preg_match("/,".$value['backend_menu_id']."C,/i", $userPermissionLists) && $uri_2 =='lists') || $userPermissionLists=="all"){
								$permissiionPass = true;
							}


							if(!$permissiionPass){
								$alerts[$this->config->item('alertDanger')] = '您沒有權限可以'.$sidebarPermissionType[$permissionKey].'此頁面';
								$this->showAlerts($alerts, $_SERVER['HTTP_REFERER']);
							}
							if($uri_2 =='deleteAction' || $uri_2 =='deleteDetailAction'){
								$this->checkPassword();
							}
						}

						foreach($permissionController as $k=>$v){
							$this->permission[$k] = false;
							if($value['backend_menu_parent_id']==0){
								if(preg_match("/,".$firstField."[".$v."],/i", $userPermissionLists) || $userPermissionLists=="all"){
									$this->permission[$k] = true;
								}
							} else {
								if(preg_match("/,".$secondField."[".$v."],/i", $userPermissionLists) || $userPermissionLists=="all"){
									$this->permission[$k] = true;
								}
							}
						}
					}
				}
			}
		}
	}

	protected function showView($view, $data=[]){
		$denyHeaderList = array('/login', '/error/404');
		$denySideBarList = array('/login', '/error/404');
		$denyTemplateList = array('/login', '/error/404');
		$denyFooterList = array('/login', '/error/404');

		$loadHeader = !in_array($view, $denyHeaderList);
		$loadSideBar = !in_array($view, $denySideBarList);
		$loadTemplate = !in_array($view, $denyTemplateList) && isset($data['template']);
		$loadFooter = !in_array($view, $denyFooterList);

		// 載入 head
		$data['head'] = isset($data['head']) ? $data['head'] : [];
		$data['headHtml'] = $this->load->view('/common/head', $data['head'], true);

		// 載入 head
		$data['alerts'] = isset($data['alerts']) ? $data['alerts'] : [];
		$data['alertsHtml'] = $this->load->view('/common/alerts', $data['alerts'], true);

		$data['scripts']['controllerName'] = $this->controllerName;
		$data['scripts']['permission'] = $this->permission;
		$data['scriptsHtml'] = $this->load->view('/common/scripts', $data['scripts'], true);

		$data['block']['controllerName'] = $this->controllerName;
		$data['blockAlertsHtml'] = $this->load->view('/common/block_alerts', $data['block'], true);

		// 載入 header
		if( $loadHeader ){
			$data['header'] = isset($data['header']) ? $data['header'] : [];
			$data['headerHtml'] = $this->load->view('/common/header', $data['header'], true);
		}

		// 載入 sidebar
		if( $loadSideBar ){
			$data['sidebar'] = isset($data['sidebar']) ? $data['sidebar'] : [];
			$data['sidebar']['sidebarMenu'] = isset($this->sidebarMenu)? $this->sidebarMenu : array();
			$data['sidebarHtml'] = $this->load->view('/common/sidebar', $data['sidebar'], true);
		}

		// 載入 template
		if( $loadTemplate ){
			$data['template'] = isset($data['template']) ? $data['template'] : [];
			$data['templateHtml'] = isset($data['template']['view']) ? $this->load->view($data['template']['view'], $data['template'], true) : $this->load->view($this->controllerName.'/template', $data['template'], true);
		}

		// 載入 footer
		if( $loadFooter ){
			$data['footer'] = isset($data['footer']) ? $data['footer'] : [];
			$data['footerHtml'] = $this->load->view('/common/footer', $data['footer'], true);
		}

		// 載入 body
		$this->load->view($view, $data);
	}


	protected function showAlerts($data=[], $url=''){
		$result = json_encode($data);
		$this->session->set_flashdata('alerts', $result);
		if( $url ){
			redirect($url);
		}
	}

	// 取得分頁設定
	protected function getPageConfig(){
		$pageConfig['full_tag_open'] = '<div class="col-md-12 col-sm-12 text-center"><div class="dataTables_paginate paging_bootstrap_number"><ul class="pagination" style="visibility: visible;">';
		$pageConfig['full_tag_close'] = '</ul></div></div>';
		$pageConfig['per_page'] = 10;
		$pageConfig['num_links'] = 5;
		$pageConfig['query_string_segment'] = 'page';
		$pageConfig['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$pageConfig['prev_tag_open'] = '<li class="prev">';
		$pageConfig['prev_tag_close'] = '</li>';
		$pageConfig['next_link'] = '<i class="fa fa-angle-right"></i>';
		$pageConfig['next_tag_open'] = '<li class="next">';
		$pageConfig['next_tag_close'] = '</li>';
		$pageConfig['cur_tag_open'] = '<li class="active"><a>';
		$pageConfig['cur_tag_close'] = '</a></li>';
		$pageConfig['num_tag_open'] = '<li>';
		$pageConfig['num_tag_close'] = '</li>';
		$pageConfig['page_query_string'] = true;
		$pageConfig['use_page_numbers'] = true;
		$pageConfig['first_link'] = false;
		$pageConfig['last_link'] = false;

		return $pageConfig;
	}

	//將陣列的key和value組合成Http Get的格式
	protected function combineGetParams($queryParams){
		$httpGetParams = '';
		foreach($queryParams as $key => $value){

			if(!is_array($value) && (trim($value) || $value === 0)){

				$httpGetParams .= '&' . $key . '=' .$value;
			}elseif(is_array($value)){
				foreach($value as $single_value){
					$httpGetParams .= '&' . $key . '[]=' .$single_value;
				}
			}
		}
		return $httpGetParams;
	}

	//取得目前頁數的位移
	protected function getCurrentPageOffset($num, $maxNum){
		$offset = $this->input->get('page', true) ? $this->input->get('page', true) : 1;
		$offset = ($offset - 1) * $num;

		//判斷到這頁的總數是否大於total_rows數 如果大於代表超過頁數，引導至最後一頁
		if( $maxNum != 0 ){
			if($offset >= $maxNum){
				$page = 0;
				if( $maxNum % $num == 0){
					$page = $maxNum / $num;
				}else{
					$page = (int)( $maxNum / $num ) + 1;
				}
				//redirect($this->pagination->base_url.'&page='.$page);
			}
		}
		return $offset;
	}

	protected function postFieldChekck($saveField, $haveField, $dataList = array()){

		// 密碼驗證
		$this->checkPassword();

		$dataList = !empty($dataList)? $dataList : $this->input->post();

		$returnData = $dangerField = $dangerDataType = [];
		foreach($saveField as $field=>$fieldInfo){

			// 檢查必填欄位是否有填寫
			if(in_array($field, $haveField) && isset($dataList[$field]) && ($fieldInfo['dataType'] != 'array' && trim($dataList[$field]) =='')){

				$dangerField[] = $fieldInfo['name'];
			} else {
				if(isset($dataList[$field])){
					// 檢查欄位型態
					if(!$this->dataTypeCheck($fieldInfo['dataType'], $dataList[$field])){
						$dangerDataType[] = $fieldInfo['name'];
					}

					// html encode
					if($fieldInfo['dataType'] == 'string'){
						$dataList[$field] = addslashes($dataList[$field]); //stripslashes
					}
				}
			}
			if(isset($dataList[$field])){
				if($fieldInfo['dataType'] == 'array'){
					$returnData[$field] = $this->input->post($field, true);
				} else{
					$returnData[$field] = trim($dataList[$field]);
				}
			}
		}

		$dangerMessage = '';
		if($dangerField){
			$dangerMessage = implode($dangerField, '、').' 欄位未填寫，';
		}

		if($dangerDataType){
			$dangerMessage .= implode($dangerDataType, '、').' 資料型態錯誤，';
		}

		if($dangerMessage !=''){

			$alerts[$this->config->item('alertDanger')] = $dangerMessage.'請重新填寫!';
			$this->showAlerts($alerts);
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			return $returnData;
		}
	}

	protected function dataTypeCheck($dataType, $value){
		switch ($dataType) {
			case 'bool':
				return is_bool($value);
				break;

			case 'integer':
				return is_numeric($value);
				break;

			case 'float':
				return is_float($value);
				break;

			case 'double':
				return is_double($value);
				break;

			case 'string':
				return (is_string($value)? is_string($value) : is_numeric($value));
				break;

			case 'array':
				return is_array($value);
				break;

			case 'object':
				return is_object($value);
				break;

			case 'resource':
				return is_resource($value);
				break;
		}
	}

	protected function checkPassword(){

		$this->load->model('home_model');
		$users_password = $this->input->post('chk_password', true);
		$users_account = $this->session->userdata('ubmsys_users_account');
		$dbPassword = $this->sha256Decode(implode(" ",$this->home_model->checkUsersPassword($users_account)));

		if( $users_password != $dbPassword ){
			$alerts[$this->config->item('alertDanger')] = '密碼填寫錯誤！請重新填寫';
			$this->showAlerts($alerts, $_SERVER['HTTP_REFERER']);
		}
	}

	protected function moveFile($fromFile , $toFile){

		//檢查目錄是否存在
		$urls = explode('/', $toFile);
		$path = '';
		foreach($urls as $va){
			if(!strpos($va, '.')){
				$path .= $va.'/';
				if( !is_dir($path) ){
					mkdir($path, 0777);
				}
			}
		}

		rename('./'.$fromFile ,'./'.$toFile);

		return true;
	}

	protected function createKeyFile(){
		$keyFileName = $this->config->item('keyFileName');
		foreach( $keyFileName as $val ){
			if( !file_exists($val) ){
				$key = bin2hex($this->encryption->create_key(16));
				$file = fopen($val, 'w');
				fwrite($file, $key);
				fclose($file);
			}
		}
	}

	protected function sha256Encode($data){
		$keyArray = $this->getKey();
		$result = $this->encryption->encrypt(
			$data,
			array(
				'cipher' => 'blowfish',
				'mode' => 'cbc',
				'key' => $keyArray[0],
				'hmac_digest' => 'sha256',
				'hmac_key' => $keyArray[1]
			)
		);
		return base64_encode($result);
	}

	protected function sha256Decode($data){
		$keyArray = $this->getKey();
		$result = $this->encryption->decrypt(
			base64_decode($data),
			array(
				'cipher' => 'blowfish',
				'mode' => 'cbc',
				'key' => $keyArray[0],
				'hmac_digest' => 'sha256',
				'hmac_key' => $keyArray[1]
			)
		);
		return $result;
	}

	protected function getKey(){
		$keyFileName = $this->config->item('keyFileName');
		$keyArray = [];
		foreach( $keyFileName as $val ){
			$path = dirname(dirname(dirname( __FILE__ ))).'/'.$val;
			$file = fopen($val, 'r');
			$key = fgets($file);
			fclose($file);
			$keyArray[] = hex2bin($key);
		}
		return $keyArray;
	}

	protected function parserStr($var)
	{

		// 排除掉白名單IP edit by Leo 20140703

		//mysql_query("SET NAMES 'UTF8'");

		$strPost = "";
		if (isset($_GET[$var])){
			if (is_array($_GET[$var])){
				$strPost = $_GET[$var];
			}else{
				$strPost = addslashes($_GET[$var]);
			}
		}elseif (isset($_POST[$var])){
			if (is_array($_POST[$var])){
				$strPost = $_POST[$var];
			}else{
				$strPost = addslashes($_POST[$var]);
			}
		}elseif (isset($_COOKIE[$var])){
			if (is_array($_COOKIE[$var])){
				$strPost = $_COOKIE[$var];
			}else{
				$strPost = addslashes($_COOKIE[$var]);
			}
		}

		// sql injection Check Start

		$kw = array(
			'update',
			'select',
			'script',
			'insert',
			//'iframe',
			'drop',
			'delete',
			' alert',
			'<script',
			' or ',
			'onmouse',
		);
		if (isset($_COOKIE[$var])){
			$kw = array(
				'update',
				'select',
				'script',
				'insert',
				//'iframe',
				'drop',
				'delete',
				' alert',
				'<script',
				' or ',
				'onmouse',
				'('
			);
		}
		$b_valid = true;

		if (is_array($strPost)){
			foreach($strPost as $key => $va){
				$loStrPost = strtolower($va);
				
				foreach($kw as $va){
					if (stripos( $loStrPost , $va) !== false) {$b_valid = false;}
				}
			}
		}else{
			$loStrPost = strtolower($strPost);
			foreach($kw as $va){
				if (stripos( $loStrPost , $va) !== false) {$b_valid = false;}
			}
		}

		if ($b_valid == false){
			header('Location: http://www.cipas.gov.tw');exit;
		}else{
			return $strPost;
		}
	}

	protected function urlParserStr($strUrl)
	{

		// 排除掉 XSS script 攻擊
		// sql injection Check Start

		$kw = array(
			'script>',
			'onmouse',
			'<img',
			//'<iframe',
			'<xss',
			'onclick=',
			'<a',
			'onload=',
			'<script',
			'<applet',
			'<body',
			'<embed',
			'<frame',
			'<frameset',
			'<html',
			'<img',
			'<style',
			'<layer',
			'<link',
			'<ilayer',
			'<meta',
			'<object',
			'update',
			'select',
			'script',
			'insert',
			//'iframe',
			'drop',
			'delete',
			' alert',
			'<script',
			' or ',
			'onmouse',
			'alert',
			'location',
			'=\''
		);

		$b_valid = true;
		$loStrUrl = urldecode(urldecode(strtolower($strUrl)));

		$arrwhitelist = ['deleteaction','deletedetailaction'];
		// 移除['deleteaction','deletedetailaction'], 為 function名稱
		foreach($arrwhitelist as $va){
			if (stripos($loStrUrl, $va ) !== false){
				$loStrUrl = explode('/', $loStrUrl);
				$loStrUrl = array_diff($loStrUrl, $arrwhitelist);
				$loStrUrl = implode('/', $loStrUrl);
			}
		}

		foreach($kw as $va){
			if (stripos($loStrUrl, $va) !== false){
				$b_valid = false;
			}
		}

		if ($b_valid == false){
			header('Location: http://www.cipas.gov.tw');exit;
		}else{
			return true;
		}
	}
}
