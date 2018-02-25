<?php
	Class Home extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("sanpham_model");
			$this->load->model("lsanpham_model");
			$this->load->library('form_validation');	
		}
		public function index(){
			//$this->session->unset_userdata('Login');
			 $input=array();
			$sanpham=$this->sanpham_model->get_lists($input);
			$this->data["list"]=$sanpham;
			$this->load->view("admin/home",$this->data);
		}
	}
?>