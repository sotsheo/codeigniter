<?php
	 Class Nhaphang extends MY_Controller{
	 	function __construct(){
			parent::__construct();
			$this->load->model("Nhaphang_model");
			$this->load->model("Admin_model");
			$this->load->model("Sanpham_model");
			$this->load->model('Lichsu_model');
			$this->load->model('Lsanpham_model');
			$this->load->library('form_validation');	
			$this->load->library('pagination');
		}
		public function index(){
			 $input=array();
			$nhapsanpham=$this->Nhaphang_model->get_lists($input);
			$admin=$this->Admin_model->get_lists($input);
			$sanpham=$this->Sanpham_model->get_lists($input);
			$this->data["admin"]=$admin;	
			$this->data["sanpham"]=$sanpham;	
			$config=array();
			$config['total_rows']=count($nhapsanpham);// tong so luong cua du lieu
			$config['base_url']=base_url('admin/Nhaphang/index');
			$config['per_page']=2;// so  luong hien thi tren 1 trang
			$config['uri_segment']=4;// Phan doan hien thi  tren 1 trang url
			$this->pagination->initialize($config);
			
			$input["limit"]=array($config['per_page'],intval($this->uri->segment(4)));
			$nhapsanpham=$this->Nhaphang_model->get_lists($input);
			$this->data["nhapsanpham"]=$nhapsanpham;	
			$this->load->view("admin/nhaphang/list",$this->data);
		}
		public function addSanpham(){
			$input=array();
			$sanpham=$this->Sanpham_model->get_lists($input);
			$this->data["sanpham"]=$sanpham;
			if($this->input->post()){
				$this->form_validation->set_rules('name', 'name', 'required');
				$id_sanpham=$this->input->post('sanpham');
				$gia=$this->input->post('price');
				$sl=$this->input->post('sl');
				$date=date("Y/m/d");
				$data["id_sanpham"]=$id_sanpham;
				$data["Gianhap"]=$gia;
				$data["Soluong"]=$sl;
				$data["Ngaynhap"]=$date;
				$data["id_admin"]=$this->session->userdata('Login')["id"];
				if($this->Nhaphang_model->insert($data)){
						$input["id"]=$id_sanpham;
						$sanpham=$this->Sanpham_model->get_lists($input);
						$sltk=$sanpham[0]->Soluong;
						$sltk+=$sl;
						$where["id"]=$id_sanpham;
						$datas["Soluong"]=$sltk;						
						$this->Sanpham_model->update($where,$datas);
						$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã nhập thêm so luong  sản phẩm  ".$sanpham[0]->Ten;
						$this->Lichsu_model->insert($lichsu);
						$this->session->set_flashdata('message',"Nhập   thành công ");	
						redirect(base_url("admin/Nhaphang"));

				}		
				else{
					$this->session->set_flashdata('message',"Nhập không  thành công ");	
						redirect(base_url("admin/Nhaphang"));
				}
				
				
			}			
			
			$this->load->view("admin/nhaphang/add",$this->data);
		}

		public function addSanphammoi(){
			$input=array();
			$lsanpham=$this->Lsanpham_model->get_lists($input);
			$this->data["lsanpham"]=$lsanpham;
			if($this->input->post()){
				$this->form_validation->set_rules('name', 'name', 'required');
				$name=$this->input->post('name');
				$gia=$this->input->post('price');
				$gianhap=$this->input->post('prices');
				$lsanpham=$this->input->post('lsanpham');
				$km=$this->input->post('km');
				$ma=$this->input->post('ma');
				$sl=$this->input->post('sl');
				$date=date("Y/m/d");
				$upload_path="./uploads/sanpham";
				$upload_data=$this->upload($upload_path,'image');
				$image_link='';
				if(isset($upload_data['file_name'])){
						$image_link=$upload_data['file_name'];
				}

				$data["Ten"]=$name;
				$data["Anh"]=$image_link;
				$data["Giaban"]=$gia;
				$data["Soluong"]=$sl;
				$data["Soluongban"]=0;
				$data["Khuyenmai"]=$km;
				$data["Ma"]=$ma;
				$data["id_stypes"]=$lsanpham;
				if($this->Sanpham_model->insert($data)){
					$lichsu["Noidung"]=$this->session->userdata('Login')." Đã  thêm  sản phẩm  ".$name;
					$this->Lichsu_model->insert($lichsu);
					$sanpham=$this->Sanpham_model->get_max_id();
					$datas["id_sanpham"]=$sanpham["id"];
					$datas["Gianhap"]=$gia;
					$datas["Soluong"]=$sl;
					$datas["Ngaynhap"]=$date;
					$datas["id_admin"]=$this->session->userdata('Login')["id"];
					if($this->Nhaphang_model->insert($datas)){
						$input["id"]=$sanpham["id"];
						$sanpham=$this->Sanpham_model->get_lists($input);
						$lichsus["Noidung"]=$this->session->userdata('Login')["Username"]." Đã nhập thêm  sản phẩm  ".$sanpham[0]->Ten;
						$lichsus["Ngay"]=date("Y/m/d H:i");
						$this->Lichsu_model->insert($lichsus);
						$this->session->set_flashdata('message',"Nhập   thành công ");	
							redirect(base_url("admin/Nhaphang"));
					}
				else{
					$this->session->set_flashdata('message',"Nhập  không thành công ");	
							redirect(base_url("admin/Nhaphang"));
				}
			}	
		}
			
			$this->load->view("admin/nhaphang/addsp",$this->data);
		}

		//edit
		function edit(){
			$input=array();
			$url=$this->uri->segment(4);
			// lay  nhapsanpham co id
			$nhapsanpham=$this->Nhaphang_model->get_info($url);
			if(!$nhapsanpham){
				redirect(base_url('admin/danhmuc'));
			}
			
			$this->data['nhapsanpham']=$nhapsanpham;			
			// lay danhh sach cua san pham
			$product=$this->Sanpham_model->get_lists($input);
			$this->data['sanpham']=$product;
			// lay soluong cua san pham thu id_sanpahm
			 $sanpham=$this->Sanpham_model->get_info($nhapsanpham->id_sanpham);

			 // gan gia tri so luong bang voi sl trong kho
			 $sltamp= $sanpham->Soluong;
			 // gan gt sltamp bang so luong trong kho tru di sl da nhap
			 $sltamp-=$nhapsanpham->soluong;
			// kiem tra khi post
			if($this->input->post()){
				$this->form_validation->set_rules('sanpham', 'sanpham', 'required');
				$id_sanpham=$this->input->post('sanpham');
				$gia=$this->input->post('price');
				$sl=$this->input->post('sl');
				$date=date("Y/m/d");
				$data["id_sanpham"]=$id_sanpham;
				$data["Gianhap"]=$gia;
				$data["Soluong"]=$sl;
				$data["Ngaynhap"]=$date;
				$dulieu="";
				if($gia!=$nhapsanpham->Gianhap){
					$dulieu.="Đã update giá nhập ";
				}
				if($sl!=$nhapsanpham->soluong){
					$dulieu.="Đã update số lượng ";
				}

				//kiem tra so luong nhap vao co duoi 0 hay khong
				if(($sltamp+=$sl)>=0){
					$where["id"]=$url;
					if($this->Nhaphang_model->update($where,$data)){
						// update san pham 
						$input["id"]=$id_sanpham;
						$sanpham=$this->Sanpham_model->get_lists($input);
						$edit["Soluong"]=$sltamp;
						$lichsus["Noidung"]=$this->session->userdata('Login')["Username"].$dulieu." sản phẩm  ".$sanpham[0]->Ten;
						$this->Lichsu_model->insert($lichsus);
						if($this->Sanpham_model->update($input,$edit)){
							$lichsus["Noidung"]=$this->session->userdata('Login')." Đã update   sản phẩm  ".$sanpham[0]->Ten;
							$lichsus["Ngay"]=date("Y/m/d H:i");
							$this->Lichsu_model->insert($lichsus);
							$this->session->set_flashdata('message',"Edit thành công ");	
							redirect(base_url("admin/Nhaphang"));
						}
					}
					else{
					$this->session->set_flashdata('message',"Edit  không thành công ");	
							redirect(base_url("admin/Nhaphang"));
							}
				}
				else{
					$this->session->set_flashdata('message',"Edit  không thành công ");	
							redirect(base_url("admin/Nhaphang"));
				}
			}
			$this->load->view("admin/nhaphang/edit",$this->data);
		}

		//edit
		function delete(){
			$input=array();
			$url=$this->uri->segment(4);
			// lay  nhapsanpham co id
			$nhapsanpham=$this->Nhaphang_model->get_info($url);
			if(!$nhapsanpham){
				redirect(base_url('admin/nhaphang'));
			}
			
			$this->data['nhapsanpham']=$nhapsanpham;			
			// lay danhh sach cua san pham
			$product=$this->Sanpham_model->get_lists($input);
			$this->data['sanpham']=$product;
			// lay soluong cua san pham thu id_sanpahm
			 $sanpham=$this->Sanpham_model->get_info($nhapsanpham->id_sanpham);

			 // gan gia tri so luong bang voi sl trong kho
			 $sltamp= $sanpham->Soluong;
			 // gan gt sltamp bang so luong trong kho tru di sl da nhap
			 $sltamp-=$nhapsanpham->soluong;
				// kiem tra so luong nhap vao co duoi 0 hay khong
				 if($sltamp>=0){
				 	$input["id"]=$sanpham->id;
				 	$edit["Soluong"]=$sltamp;
				 	$where["id"]=$url;
				 	if($this->Sanpham_model->update($input,$edit)){
				 		
				 		if($this->Nhaphang_model->dele($where)){
						// update san pham 
						$lichsus["Noidung"]=$this->session->userdata('Login')["Username"]."Đã xóa nhập hàng  sản phẩm  ".$sanpham->Ten;
						$date=date("Y/m/d h:s");
						$lichsus["Ngay"]=date("Y/m/d H:i");
						$this->Lichsu_model->insert($lichsus);
						
						 	redirect(base_url("admin/Nhaphang"));
						}
				 	}
				 	
				 	
				 }
				else{
					$this->session->set_flashdata('message',"Xóa không  thành công ");	
					redirect(base_url("admin/Nhaphang"));
				}
			
		}

		// upload file
		//$upload_path la duong dan 
		// $file_name la ten cua the input
		function upload($upload_path='',$file_name=''){
			$config=$this->config($upload_path);
			$this->load->library('upload',$config);
			// thuc hien upload
			if($this->upload->do_upload($file_name)){

				$data=$this->upload->data();
			}
			else{
				$data=$this->upload->display_errors();

			}
			return $data;
		}

		function config($upload_path=''){
			// khai bao cau hinh
        	// $this->load->library('upload', $config);
			$config=array();
			$config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width']  = '1024';
            $config['max_height']  = '1024';
			return $config;
		}
	 }
?>