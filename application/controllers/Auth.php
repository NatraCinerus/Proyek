<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');
	}
	
	//halaman login
	public function index(){
		if(!$this->session->userdata('username')){
			$this->load->view('crud/login');
		}else{
			redirect('crud');
		}
	}

	public function login() {
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$res = $this->user_model->check_login($username, $password);
		
		if ($res != false) {
			$this->session->set_userdata('username', $res->username);
			$this->session->set_userdata('password', $res->password);
			$this->session->set_userdata('level', $res->level);
			
			if ($this->session->userdata('level')=='admin') {
				redirect('crud');
			}elseif ($this->session->userdata('level')=='member') {
				redirect('member/c_member');
			}		
		}else{
			echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
		}
	}
	
	public function logout(){
		$this->session->unset_userdata();
		$this->session->sess_destroy();
		redirect('auth');
	}
}
