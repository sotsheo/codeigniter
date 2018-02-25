<?php
	 Class Login extends MY_Controller{
	 	function __construct(){
	 		parent::__construct();
	 		$this->load->model('Admin_model');
	 	}
	 	public function index(){	 		
			$this->load->library('form_validation');	
			if($this->input->post()){
				$this->form_validation->set_rules('login','Login','callback_check_login');
				
				if($this->form_validation->run()){					
					redirect(base_url("admin/Sanpham"));					
				}
			}
			
			$this->load->view('admin/login');
			
	 		
	 	}
	 	
	 	function check_login(){
			
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			$password=$password;
			$where=array('username'=>$username,'password'=>md5($password));		
			$admin='';
			$this->load->model('Admin_model');
			if($this->Admin_model->exists($where)){
				$admin=$this->Admin_model->get_lists($where);
				$data["id"]=$admin[0]->id;
				$data["Username"]=$admin[0]->Username;
			}						
			if($admin){
				$this->session->set_userdata('Login',$data);				
				return true;
			}
			return false;
		}
	 }
?>