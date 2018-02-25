<?php
	Class User extends MY_Controller{
	 	function __construct(){
			parent::__construct();
			$this->load->model('User_model');
			$this->load->model('Lichsu_model');
			$this->load->model('Banhang_model');
			$this->load->library('form_validation');
			$this->load->library('pagination');		
		}
		public function index(){			
			$input=array();
			$user=$this->User_model->get_lists($input);
		
			// lay noi dung bien message
			$message=$this->session->flashdata('message');
			$config=array();
			$config['total_rows']=count($user);// tong so luong cua du lieu
			$config['base_url']=base_url('admin/User/index');
			$config['per_page']=2;// so  luong hien thi tren 1 trang
			$config['uri_segment']=4;// Phan doan hien thi  tren 1 trang url
			$this->pagination->initialize($config);
			
			$input["limit"]=array($config['per_page'],intval($this->uri->segment(4)));
			$user=$this->User_model->get_lists($input);
			$this->data['user']=$user;
			//$this->data['temp']='admin/admin/index';
			$this->load->view("admin/User/list",$this->data);
			
		}
		public function add(){	
			
			if($this->input->post()){
				$this->form_validation->set_rules('name', 'name', 'required');
				$name=$this->input->post('name');
				$age=$this->input->post('age');
				$type=$this->input->post('type');
				$email=$this->input->post('email');
				$diachi=$this->input->post('diachi');
				$dienthoai=$this->input->post('dienthoai');
				$data["Ten"]=$name;
				$data["Tuoi"]=$age;
				$data["Type"]=$type;
				$data["Email"]=$email;
				$data["Diachi"]=$diachi;
				$data["Dienthoai"]=$dienthoai;					
				$data["Ngaytao"]=date("Y/m/d");
				if($this->form_validation->run()){	

					if($this->User_model->insert($data)){
						$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã edit Danh mục ".$data["Ten"];
						$lichsu["Ngay"]=date("Y/m/d H:i");
						$this->Lichsu_model->insert($lichsu);
						$this->session->set_flashdata('message',"Thêm danh mục  thành công ");	
						redirect(base_url("admin/User"));
					}
					else{
						$this->session->set_flashdata('message',"Thêm danh mục không thành công ");	
						redirect(base_url("admin/User"));
					}
				}
			}
			
			$this->load->view("admin/user/add");
		}

		function edit(){
			$input=array();
			$url=$this->uri->segment(4);
			
			$user=$this->User_model->get_info($url);
			if(!$user){
				redirect(base_url('admin/danhmuc'));
			}
			$this->data['user']=$user;
			
			if($this->input->post()){
			$this->form_validation->set_rules('name', 'name', 'required');
			$name=$this->input->post('name');
			$age=$this->input->post('age');
			$type=$this->input->post('type');
			$email=$this->input->post('email');
			$diachi=$this->input->post('diachi');
			$dienthoai=$this->input->post('dienthoai');
			$data["Ten"]=$name;
			$data["Tuoi"]=$age;
			$data["Type"]=$type;
			$data["Email"]=$email;
			$data["Diachi"]=$diachi;
			$data["Dienthoai"]=$dienthoai;					
			$data["Ngaytao"]=date("Y/m/d");
				$where["id"]=$url;
				if($this->User_model->update($where,$data)){
					$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã edit khách hàng ".$data["Ten"];
					$lichsu["Ngay"]=date("Y/m/d H:i");
						$this->Lichsu_model->insert($lichsu);
							$this->session->set_flashdata('message',"Edit dữ liệu thành công ");	
							redirect(base_url("admin/User"));
						
					}
				else{
							$this->session->set_flashdata('message',"Edit dữ liệu không thành công ");	
							redirect(base_url("admin/User"));
					}

				}		
			$this->load->view("admin/User/edit",$this->data);
		}
		// xoa du lieu 
		function delete(){
			$url=$this->uri->segment(4);
			$where["id"]=$url;
			$khach=$this->User_model->get_info($url);
			$khachs["id_khach"]=$khach->id;
			//echo ()
			$bh=$this->Banhang_model->get_lists($khachs);
			if($bh){
				$this->session->set_flashdata('message','Không thể xóa khi dữ liệu còn bán hàng');
				redirect(base_url("admin/User"));
			}
			if(!$khach){	
				$this->session->set_flashdata('message',"Không có sản phẩm nào ");			
				redirect(base_url("admin/User"));
			}
			else{
				$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã xóa khách hàng ".$khach->Ten;
				if($this->User_model->dele($where)){
					$lichsu["Ngay"]=date("Y/m/d H:i");
					$this->Lichsu_model->insert($lichsu);
					$this->session->set_flashdata('message',"Xóa thành công đữ liệu ");		
					redirect(base_url("admin/User"));
				}
			}
		}
	}
?>