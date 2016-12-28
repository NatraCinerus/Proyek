<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('crud_model');
		$this->load->library('session');
		if(!$this->session->userdata('username')){
			redirect('auth');
		}
	}
	
	//load halaman utama
	function index(){
		// $data['books'] = $this->crud_model->get_all();
		$data['content'] = 'crud/crud_view';
		
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'crud';
		$config['total_rows'] = $this->crud_model->count_all();
		$config['per_page'] = 4;
		$config['uri_segment'] = 2;
		
		//config bootstrap
		$config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		$data['books'] = $this->crud_model->get_all($config['per_page'], $this->uri->segment(2));
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view('home_view', $data);
	}
	
	//add buku
	function add(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('judul','Judul','trim|required');
		$this->form_validation->set_rules('pengarang','Pengaran','trim|required');
		$this->form_validation->set_rules('kategori','Kategori','trim|required');
		
		if( $this->form_validation->run() == false ){
			$data['content'] = 'crud/books_add_view';
			$this->load->view('home_view', $data);
		}else{
			$this->crud_model->add_book($this->input->post('judul'),$this->input->post('pengarang'),$this->input->post('kategori'));
			redirect('crud/','refresh');
		}
	}
	
	//edit buku
	function edit($id){
		$data['book'] = $this->crud_model->get_book($id);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('judul','Judul','trim|required');
		$this->form_validation->set_rules('pengarang','Pengaran','trim|required');
		$this->form_validation->set_rules('kategori','Kategori','trim|required');
		if( $this->form_validation->run() == false ){
			$data['content'] = 'crud/books_edit_view';
			$this->load->view('home_view', $data);
		}else{
			$this->crud_model->edit_book($id, $this->input->post('judul'),$this->input->post('pengarang'),$this->input->post('kategori'));
			redirect('crud/','refresh');
		}
	}
	
	//delete buku
	function delete($id){
		$this->crud_model->delete_book($id);
		redirect('crud/','refresh');
	}
	
	//upload file attachment (gambar)
	function add_attachment($id){
		$data['book'] = $this->crud_model->get_book($id);
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpeg|jpg|gif|png';
		$config['max_size'] = '1024';
		$config['max_width'] = '2024';
		$config['max_height'] = '1468';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		
		$data['content'] = 'crud/attach_add_view';
		$this->load->view('home_view', $data);
		
		if (!$this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors());
			//$this->load->view('upload_form', $error);
		} else {
			$infofile = $this->upload->data();
			$data['file_name'] = $infofile['file_name'];
			$data['file_size'] = $infofile['file_size'];
			$data['file_extention'] = $infofile['file_ext'];
			$filename = $data['file_name'];
			$this->crud_model->add_attachment($id, $filename);
			redirect('crud/','refresh');
		}
	}
	
	//download file attachment (gambar)
	function download_attachment($filename){
		$this->load->helper('download');
		$path = base_url().'uploads/'.$filename;
		$data = file_get_contents($path); // Read the file's contents
		force_download($filename, $data);
	}
	
	//searching
	function search(){
		$q = $this->input->post('search');	
		$data['content'] = 'crud/crud_view';
		
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'crud/search';
		$config['total_rows'] = $this->crud_model->count_search($q);
		$config['per_page'] = 4;
		$config['uri_segment'] = 3;
		
		//config bootstrap
		$config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		$data['books'] = $this->crud_model->get_search($q, $config['per_page'], $this->uri->segment(3));
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view('home_view', $data);
	}

	//searching ajax
	function ajax_search(){
		$q = $this->input->post('search');	
		$data['content'] = 'crud/crud_view';
		$data['books'] = $this->crud_model->get_search($q);

		echo json_encode($data['books']);
	}
}
