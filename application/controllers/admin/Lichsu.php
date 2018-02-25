<?php
	 Class Lichsu extends MY_Controller{
	 	function __construct(){
			parent::__construct();
			$this->load->model('Lichsu_model');
			$this->load->library('form_validation');	
			$this->load->library('pagination');	
		}
		public function index(){
			
			// lay du lieu cua danh muc truoc
			$input=array();
			$lichsus=$this->Lichsu_model->get_lists($input);
			
			$config=array();
			$config['total_rows']=count($lichsus);// tong so luong cua du lieu
			$config['base_url']=base_url('admin/Lichsu/index');
			$config['per_page']=10;// so  luong hien thi tren 1 trang
			$config['uri_segment']=4;// Phan doan hien thi  tren 1 trang url
			$this->pagination->initialize($config);
			
			$input["limit"]=array($config['per_page'],intval($this->uri->segment(4)));
			$lichsu=$this->Lichsu_model->get_lists($input);
			$this->data['lichsu']=$lichsu;
			$this->data['lichsus']=$lichsus;
			$this->load->view("admin/lichsu/list",$this->data);
			
		}
		public function search(){

			
				$ngay=$this->input->post("ls");
				if(!$ngay){
					redirect(base_url("admin/Lichsu"));
				}
				$input=array();
				$input["like"]["Ngay"]=$ngay;
				$lichsus=$this->Lichsu_model->get_lists($input);
				$lichsu=$this->Lichsu_model->get_lists($input);
				$this->data['lichsu']=$lichsu;
				$this->data['lichsus']=$lichsus;
				$this->load->view("admin/lichsu/list",$this->data);
			
		}
		
	 }
?>