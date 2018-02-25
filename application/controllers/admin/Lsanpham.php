<?php
	 Class Lsanpham extends MY_Controller{
	 	function __construct(){
			parent::__construct();
			$this->load->model('Danhmuc_model');
			$this->load->model('Lsanpham_model');
			$this->load->model('Lichsu_model');
			$this->load->library('form_validation');
			$this->load->library('pagination');	
		}
		public function index(){
			
			// lay du lieu cua danh muc truoc
			$input=array();
			$danhmuc=$this->Danhmuc_model->get_lists($input);
			// lay du lieu slsanpham
			$lsanpham=$this->Lsanpham_model->get_lists($input);
			$this->data['danhmuc']=$danhmuc;

			$config=array();
			$config['total_rows']=count($lsanpham);// tong so luong cua du lieu
			$config['base_url']=base_url('admin/Lsanpham/index');
			$config['per_page']=2;// so  luong hien thi tren 1 trang
			$config['uri_segment']=4;// Phan doan hien thi  tren 1 trang url
			$this->pagination->initialize($config);
			
			$input["limit"]=array($config['per_page'],intval($this->uri->segment(4)));
			$lsanpham=$this->Lsanpham_model->get_lists($input);
			$this->data['lsanpham']=$lsanpham;
			//$this->data['temp']='admin/admin/index';
			$this->load->view("admin/kieusanpham/list",$this->data);
			
		}
		public function add(){
			$input=array();
			 $list=$this->Danhmuc_model->get_lists($input);
			$this->data['list']=$list;
			
			if($this->input->post()){
				$this->form_validation->set_rules('name', 'name', 'required');
				$danhmuc=$this->input->post('danhmuc');
				$name=$this->input->post('name');
				$data["Ten"]=$name;
				$data["id_list"]=$danhmuc;
				if($this->Lsanpham_model->insert($data)){
						$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã thêm Loại sản phẩm  ".$data;
						$this->Lichsu_model->insert($lichsu);
						$this->session->set_flashdata('message',"Thêm loại sản phẩm  thành công ");	
						redirect(base_url("admin/Lsanpham"));

				}		
				else{
					$this->session->set_flashdata('message',"Thêm loại sản phẩm không thành công ");	
						redirect(base_url("admin/Lsanpham"));
				}
				
			}			
			$this->load->view("admin/kieusanpham/add",$this->data);
		}
		// Edit du lieu
		function edit(){
			$url=$this->uri->segment(4);
			
			$product=$this->Lsanpham_model->get_info($url);
			if(!$product){
				redirect(base_url('admin/danhmuc'));
			}
			$input=array();
			$danhmuc=$this->Danhmuc_model->get_lists($input);			
			$this->data['product']=$product;
			$this->data['danhmuc']=$danhmuc;
			if($this->input->post()){
				$this->form_validation->set_rules('name', 'name', 'required');
				$name=$this->input->post('name');
				$content=$this->input->post('content');
				$danhmuc=$this->input->post('danhmuc');
				$data["Ten"]=$name;		
				$data["id_list"]=$danhmuc;				
				$where["id"]=$url;
				if($this->form_validation->run()){	

					if($this->Lsanpham_model->update($where,$data)){
						$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã thêm Loại sản phẩm  ".$data;
						$this->Lichsu_model->insert($lichsu);
						$this->session->set_flashdata('message',"Edit thành công ");	
						redirect(base_url("admin/Lsanpham"));
					}
				}
				else{
					$this->session->set_flashdata('message',"Edit không thành công ");	
						redirect(base_url("admin/Lsanpham"));
				}
			}
			$this->load->view("admin/kieusanpham/edit",$this->data);
		}
		// Xoa du lieu
		function delete(){
			$url=$this->uri->segment(4);
			
			$product=$this->Lsanpham_model->get_info($url);

			if(!$product){
				redirect(base_url('admin/Lsanpham'));
			}
			else{
				$where["id"]=$url;
				$lichsu["Noidung"]=$this->session->userdata('Login')["Username"]." Đã xóa Loại sản phẩm  ".$product->Ten;
				if($this->Lsanpham_model->dele($where)){
					
						$this->Lichsu_model->insert($lichsu);
						$this->session->set_flashdata('message',"Xóa  thành công ");	
						redirect(base_url("admin/Lsanpham"));
						
				}
				else{
					$this->session->set_flashdata('message',"Xóa  không thành công ");	
						redirect(base_url("admin/Lsanpham"));
						
				}
			}
			
		}

		public function search(){		

			if($this->input->post()){
				$danhmucs=$this->input->post("danhmuc");
				//echo($danhmuc);
				$input=array();
				$danhmuc=$this->Danhmuc_model->get_lists($input);			
				$this->data['danhmuc']=$danhmuc;
				$input["where"]["id_list"]=$danhmucs;
				$lsanpham=$this->Lsanpham_model->get_lists($input);				
				$this->data['lsanpham']=$lsanpham;
				$this->load->view("admin/kieusanpham/list",$this->data);
			}
			
			
		}
	 }
?>