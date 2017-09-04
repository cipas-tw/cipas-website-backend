<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_BackendController {
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'models');
		$this->load->model('UsersLog_model');
		$this->unit = 'Home';
	}

	public function index(){
		$data = [];
		$data['sidebar']['active'] = 'home';
		$data['unit'] = $this->unit;
		$this->showView('home', $data);
	}

	public function login(){
		if( $this->session->userdata('ubmsys_user_id') ){
			redirect('Home');
		}else{
			$data = [];
			$data['op'] = 'login';
			if( $this->input->post('op') === $data['op']){
				$this->loginAction();
			}

			$data['head']['includeCss'] = 'login';
			$this->showView('login', $data);
		}
	}

	protected function loginAction(){
		$queryData = $this->input->post();
		$remember = isset($queryData['remember']) ? $queryData['remember'] : 0;
		$password = $queryData['users_password'];

		unset($queryData['op']);
		unset($queryData['remember']);
		$queryData['users_password'] = $this->sha256Encode($queryData['users_password']);
		$queryData = array_map('trim',$queryData);
		$dbPassword = $this->sha256Decode(implode(" ",$this->models->checkUsersPassword($queryData['users_account'])));

		if( $password === $dbPassword ){
			if( $remember == 1 ){
				setcookie('ubmsys_users_account', $queryData['users_account'], time() + 86400);
				setcookie('ubmsys_users_password', $password, time() + 86400);
			}else{
				setcookie('ubmsys_users_account', $queryData['users_account'], time() + 0);
				setcookie('ubmsys_users_password', $password, time() + 0);
			}
			$result = $this->models->getUsersData($queryData['users_account']);
			$this->session->set_userdata('ubmsys_users_id', $result['users_id']);
			$this->session->set_userdata('ubmsys_users_name', $result['users_name']);
			$this->session->set_userdata('ubmsys_users_account', $result['users_account']);
			$alerts[$this->config->item('alertSuccess')] = '登入成功';
			$this->UsersLog_model->login_log($result,'3',"before");	 // log 紀錄
			$this->showAlerts($alerts);
			redirect('home');
		}else{
			redirect('home/login');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		$data = (array)$this->session;
		$this->UsersLog_model->logout_log($data,'4',"after");	 // log 紀錄
		redirect('home/login');
	}

	public function forgetAction(){
		$queryData = $this->input->post();
		if( $queryData['op'] === 'forget' ){
			$queryData = array_map('trim',$queryData);
			$result = $this->models->checkUsersAccount($queryData['users_account']);
			if( $result === 1 ){
				$result = $this->models->getUsersEmail($queryData['users_account']);
				//發信
			}
			redirect('home/login');
		}
	}

	public function view404(){
		$data = [];
		$data['head']['includeCss'] = 'error';
		$data['unit'] = '404';
		$this->showView('view404', $data);
	}

	public function view500(){
		$data = [];
		$data['head']['includeCss'] = 'error';
		$data['unit'] = '500';
		$this->showView('view500', $data);
	}

}
