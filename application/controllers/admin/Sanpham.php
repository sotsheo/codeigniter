<?php
	 Class Sanpham extends MY_Controller{
	 	function __construct(){
			parent::__construct();
			$this->load->model("Sanpham_model");
			$this->load->model("Nhaphang_model");
			$this->load->model("Lsanpham_model");
			$this->load->model('Lichsu_model');
			$this->load->library('form_validation');	
		}
		public function index(){
			 
			$input=array();
			$total_rows=$this->Sanpham_model->get_total();
			$sanpham=$this->Sanpham_model->get_lists($input);
			$lsp=$this->Lsanpham_model->get_lists($input);
			$this->data["lsanpham"]=$lsp;
			//load ra thu vien phan trang 
			$this->load->library('pagination');
			$config=array();
			$config['total_rows']=$total_rows;// tong so luong cua du lieu
			$config['base_url']=base_url('admin/Sanpham/index');
			$config['per_page']=2;// so  luong hien thi tren 1 trang
			$config['uri_segment']=4;// Phan doan hien thi  tren 1 trang url
			$this->pagination->initialize($config);
			
			$input["limit"]=array($config['per_page'],intval($this->uri->segment(4)));
			$sanpham=$this->Sanpham_model->get_lists($input);
			$this->data["sanpham"]=$sanpham;
			$this->load->view("admin/sanpham/list",$this->data);
		}
		public function add(){
			$input=array();
			$lsanpham=$this->Lsanpham_model->get_lists($input);
			$this->data["lsanpham"]=$lsanpham;
			if($this->input->post()){
				$this->form_validation->set_rules('name', 'name', 'required');
				$name=$this->input->post('name');
				$img=$this->input->post('image');
				$gia=$this->input->post('price');
				$lsanpham=$this->input->post('lsanpham');
				$km=$this->input->post('km');
				$ma=$this->input->post('ma');
				$upload_path="./uploads/sanpham";

				//$upload_data=$this->upload($upload_path,'image');
				$image_link='';
				if(isset($upload_data['file_name'])){
						$image_link=$upload_data['file_name'];
				}

				$data["Ten"]=$name;
				$data["Anh"]=$image_link;
				$data["Giaban"]=$gia;
				$data["Soluong"]=0;
				$data["Soluongban"]=0;
				$data["Khuyenmai"]=$km;
				$data["Ma"]=$ma;
				$data["id_stypes"]=$lsanpham;
				//echo($data["id_stypes"]);
				if($this->Sanpham_model->insert($data)){
					$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã thêm  sản phẩm  ".$name;
					$lichsu["Ngay"]=date("Y/m/d H:i");
					$this->Lichsu_model->insert($lichsu);
					$this->session->set_flashdata('message',"Thêm  thành công ");	
					redirect(base_url("admin/Sanpham"));

				}
				else{
					$this->session->set_flashdata('message',"Thêm không thành công ");	
							redirect(base_url("admin/sanpham"));
				}
				
			}			
			
			$this->load->view("admin/sanpham/add",$this->data);
		}
		//edit
		function edit(){
			$input=array();
			$url=$this->uri->segment(4);
			
			$product=$this->Sanpham_model->get_info($url);
			if(!$product){
				redirect(base_url('admin/danhmuc'));
			}
			$this->data['sanpham']=$product;
			$lsanpham=$this->Lsanpham_model->get_lists($input);
			$this->data["lsanpham"]=$lsanpham;
			if($this->input->post()){
				$this->form_validation->set_rules('name', 'name', 'required');
				$name=$this->input->post('name');
				$img=$this->input->post('image');
				$gia=$this->input->post('price');
				$lsanpham=$this->input->post('lsanpham');
				$km=$this->input->post('km');
				$ma=$this->input->post('ma');				
				$upload_path="./uploads/sanpham";
				$upload_data=$this->upload($upload_path,'image');
				$image_link='';
				if(isset($upload_data['file_name'])){
							$image_link=$upload_data['file_name'];
							$data["Anh"]=$image_link;
				}
				$data["Ten"]=$name;
				$data["Giaban"]=$gia;
				$data["Khuyenmai"]=$km;
				$data["Ma"]=$ma;
				$data["id_stypes"]=$lsanpham;
				$where["id"]=$url;
				if($this->Sanpham_model->update($where,$data)){
					$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã thêm update sản phẩm  ".$name;
					$lichsu["Ngay"]=date("Y/m/d H:i");
						$this->Lichsu_model->insert($lichsu);
							$this->session->set_flashdata('message',"Edit dữ liệu thành công ");	
							redirect(base_url("admin/sanpham"));
						
					}
				else{
							$this->session->set_flashdata('message',"Edit dữ liệu không thành công ");	
							redirect(base_url("admin/sanpham"));
					}

				}		
			$this->load->view("admin/sanpham/edit",$this->data);
		}
		//delete
		function delete(){
			$url=$this->uri->segment(4);
			$where["id"]=$url;
			$product=$this->Sanpham_model->get_info($url);
			$nsanpham["id_sanpham"]=$product->id;
			$nhapsanpham=$this->Nhaphang_model->get_lists($nsanpham);
			if($nhapsanpham){
				$this->session->set_flashdata('message','Không thể xóa khi dữ liệu còn bên nhập sản phẩm');
				redirect(base_url("admin/Sanpham"));
			}
			if(!$product){	
				$this->session->set_flashdata('message',"Không có sản phẩm nào ");			
				redirect(base_url("admin/Sanpham"));
			}
			else{
				$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã xóa sản phẩm ".$product->Ten;
				if($this->Sanpham_model->dele($where)){
					$lichsu["Ngay"]=date("Y/m/d H:i");
					$this->Lichsu_model->insert($lichsu);
					$this->session->set_flashdata('message',"Xóa thành công đữ liệu ");		
					redirect(base_url("admin/Sanpham"));
				}
			}
		}
		// search
		function search(){
			// lay du lieu 
			$input=array();
			if($this->input->post()){
				$ma=$this->input->post("msp");
				$lsp=$this->input->post("lsanpham");
				$total_rows=$this->Sanpham_model->get_total();
				$lsanpham=$this->Lsanpham_model->get_lists($input);
				if(!$ma && $lsp==0){
					redirect(base_url("admin/Sanpham"));
				}
				if($ma){
					$input['where']['Ma']=$ma;
				}
				if($lsp!=0){
					$input['where']['id_stypes']=$lsp;
				}				
				$sanpham=$this->Sanpham_model->get_lists($input);
				$this->load->library('pagination');
				$config=array();
				$config['total_rows']=count($sanpham);// tong so luong cua du lieu
				$config['base_url']=base_url('admin/Sanpham/search');
				$config['per_page']=2;// so  luong hien thi tren 1 trang
				$config['uri_segment']=5;// Phan doan hien thi  tren 1 trang url
				$this->pagination->initialize($config);
				$input["limit"]=array($config['per_page'],intval($this->uri->segment(4)));
				$sanpham=$this->Sanpham_model->get_lists($input);
				$this->data["sanpham"]=$sanpham;
				$this->data["lsanpham"]=$lsanpham;
				$this->load->view("admin/sanpham/list",$this->data);
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