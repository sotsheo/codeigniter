<?php
	 Class Danhmuc extends MY_Controller{
	 	function __construct(){
			parent::__construct();
			$this->load->model('Danhmuc_model');
			$this->load->model('Lichsu_model');
			$this->load->library('form_validation');
			$this->load->library('pagination');		
		}
		public function index(){			
			$input=array();
			$danhmuc=$this->Danhmuc_model->get_lists($input);
			$this->data['lists']=$danhmuc;
			$total=$this->Danhmuc_model->get_total();
			$this->data['total']=$total;
			// lay noi dung bien message
			$message=$this->session->flashdata('message');
			$config=array();
			$config['total_rows']=count($danhmuc);// tong so luong cua du lieu
			$config['base_url']=base_url('admin/Danhmuc/index');
			$config['per_page']=2;// so  luong hien thi tren 1 trang
			$config['uri_segment']=4;// Phan doan hien thi  tren 1 trang url
			$this->pagination->initialize($config);
			
			$input["limit"]=array($config['per_page'],intval($this->uri->segment(4)));
			$danhmuc=$this->Danhmuc_model->get_lists($input);
			$this->data['list']=$danhmuc;
			//$this->data['temp']='admin/admin/index';
			$this->load->view("admin/danhmuc/list",$this->data);
			
		}
		public function add(){	
			
			if($this->input->post()){
				$this->form_validation->set_rules('name', 'name', 'required');
				$name=$this->input->post('name');
				$content=$this->input->post('content');
				$data["Ten"]=$name;					
				
				if($this->form_validation->run()){	

					if($this->Danhmuc_model->insert($data)){
						$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã thêm Danh mục ".$Danhmuc_model;
						$lichsu["Ngay"]=date("Y/m/d H:i");
						$this->Lichsu_model->insert($lichsu);
						$this->session->set_flashdata('message',"Thêm danh mục  thành công ");	
						redirect(base_url("admin/Danhmuc"));
					}
					else{
						$this->session->set_flashdata('message',"Thêm danh mục không thành công ");	
						redirect(base_url("admin/Danhmuc"));
					}
				}
			}
			
			$this->load->view("admin/danhmuc/add");
		}
		// Edit du lieu
		function edit(){
			$url=$this->uri->segment(4);
			
			$product=$this->Danhmuc_model->get_info($url);
			if(!$product){
				redirect(base_url('admin/danhmuc'));
			}
			$this->data['product']=$product;
			if($this->input->post()){
				$this->form_validation->set_rules('name', 'name', 'required');
				$name=$this->input->post('name');
				$content=$this->input->post('content');
				$data["Ten"]=$name;					
				$where["id"]=$url;
				if($this->form_validation->run()){	

					if($this->Danhmuc_model->update($where,$data)){
						$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã update Danh mục ".$name;
						$lichsu["Ngay"]=date("Y/m/d H:i");
						$this->Lichsu_model->insert($lichsu);
						$this->session->set_flashdata('message',"Edit danh mục  thành công ");	
						redirect(base_url("admin/Danhmuc"));
					}
					else{
						$this->session->set_flashdata('message',"Edit danh mục không thành công ");	
						redirect(base_url("admin/Danhmuc"));
					}
				}
			}
			$this->load->view("admin/danhmuc/edit",$this->data);
		}
		function delete(){
			$url=$this->uri->segment(4);
			$where["id"]=$url;
			$product=$this->Danhmuc_model->get_info($url);
			if(!$product){	
				$this->session->set_flashdata('message',"Không có danh mục nào ");			
				redirect(base_url("admin/Sanpham"));
			}
			else{
				$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã xóa danh mục ".$product->Ten;
				if($this->Danhmuc_model->dele($where)){
					$lichsu["Ngay"]=date("Y/m/d H:i");
					$this->Lichsu_model->insert($lichsu);
					$this->session->set_flashdata('message',"Xóa thành công đữ liệu ");		
					redirect(base_url("admin/Sanpham"));
				}
			}
		}
		public function search(){		

			if($this->input->post()){
				$danhmuc=$this->input->post("danhmuc");
				$input=array();
				$lists=$this->Danhmuc_model->get_lists($input);
				$input["where"]["id"]=$danhmuc;
				$list=$this->Danhmuc_model->get_lists($input);
				
				$this->data['list']=$list;
				$this->data['lists']=$lists;
				$total=$this->Danhmuc_model->get_total();
				$this->data['total']=$total;
				// lay noi dung bien message
				$message=$this->session->flashdata('message');
				$this->data['message']=$message;
				//$this->data['temp']='admin/admin/index';
				$this->load->view("admin/danhmuc/list",$this->data);
			}
			
			
		}
	 }
?>