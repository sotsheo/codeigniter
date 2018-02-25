<?php
	 Class Banhang extends MY_Controller{
	 	function __construct(){
			parent::__construct();
			$this->load->model("Sanpham_model");
			$this->load->model("Admin_model");
			$this->load->model("Banhang_model");
			$this->load->model("User_model");
			$this->load->model("Lichsu_model");
			$this->load->library('form_validation');
			$this->load->library('pagination');		
		}
		public function index(){
			$input=array();

			 $this->data["xuathang"]=$this->Banhang_model->get_lists($input);
			 $this->data["sanpham"]=$this->Sanpham_model->get_lists($input);
			 $this->data["admin"]=$this->Admin_model->get_lists($input);
			 $this->data["khach"]=$this->User_model->get_lists($input);
			$config=array();
			$config['total_rows']=count($this->data["xuathang"]);// tong so luong cua du lieu
			$config['base_url']=base_url('admin/Banhang/index');
			$config['per_page']=2;// so  luong hien thi tren 1 trang
			$config['uri_segment']=4;// Phan doan hien thi  tren 1 trang url
			$this->pagination->initialize($config);
			$this->load->view("admin/Banhang/list",$this->data);
		}
		public function add(){
			$input=array();
			 $this->data["sanpham"]=$this->Sanpham_model->get_lists($input);
			 $this->data["khach"]=$this->User_model->get_lists($input);
			if($this->input->post()){
				$idanpham=$this->input->post("sanpham");
				$khach=$this->input->post("khach");
				$sl=$this->input->post("soluong");
				// kieu tra so luong co nho hon 1 khong
				if($sl<1 ){
					
						$this->session->set_flashdata('message',"Số lượng không thể nhỏ hơn 1 ");	
						$this->load->view("admin/Banhang/add",$this->data);
						return;
				}
				// lay du lieu sl san pham da get duoc
				$input['where']['id']=$idanpham;
				$sanpham=$this->Sanpham_model->get_lists($input);
				// kiem tra so luong co con trong kho
				 if($sl>$sanpham[0]->Soluong){
					$this->session->set_flashdata('message',"Số lượng trong kho không đủ ");	
					$this->load->view("admin/Banhang/add",$this->data);
					return;
				}
				else{
					$admin=$this->session->userdata('Login')["id"];
					$data["id_sanpham"]=$idanpham;
					$data["id_khach"]=$khach;
					$data["id_admin"]=$admin;
					$data["Ngayban"]=date("Y/m/d");
					$data["soluong"]=$sl;
					$tongtien=$sl*$sanpham[0]->Giaban;
					if($sanpham[0]->Khuyenmai){						
						$tongtien-=(int)(($sl*$sanpham[0]->Giaban)*$sanpham[0]->Khuyenmai/100);
						
					}
					$data["tongtien"]=$tongtien;

					
					if($this->Banhang_model->insert($data)){
						
						$sl=$sanpham[0]->Soluong-$sl;
						$sp["Soluong"]=$sl;
						$where["id"]=$idanpham;
						if($this->Sanpham_model->update($sp,$where)){
						$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã thêm bán hàng".$sanpham[0]->Ten;
						$lichsu["Ngay"]=date("Y/m/d H:i");
						$this->Lichsu_model->insert($lichsu);
						redirect(base_url("admin/Banhang"));
						}
					}
				
				}
			}
			$this->load->view("admin/Banhang/add",$this->data);
		}
	}

?>