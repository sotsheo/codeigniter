	<?php
	Class Upload_library{
		var $CI='';
		function __construct(){
			$this->CI=& get_instance();

		}
		// upload file
		//$upload_path la duong dan 
		// $file_name la ten cua the input
		function upload($upload_path='',$file_name=''){
			$config=$this->config($upload_path);
			$this->CI->load->library('upload',$config);
			// thuc hien upload
			if($this->CI->upload->do_upload($file_name)){

				$data=$this->CI->upload->data();
			}
			else{
				$data=$this->CI->upload->display_errors();

			}
			return $data;
		}
		// upload file nhhieu file
		//$upload_path la duong dan 
		// $file_name la ten cua the input
		function upload_file($upload_path='',$file_name=''){
			// cau hinh upload
			$config=$this->config($upload_path);

			//lưu biến môi trường khi thực hiện upload
	        $file  = $_FILES[$file_name];
	        $count = count($file['name']);//lấy tổng số file được upload
	        $image=array();// lu cac file anh da upload thanh cong
	        for($i=0; $i<=$count-1; $i++) {
	              
	              $_FILES['userfile']['name']     = $file['name'][$i];  //khai báo tên của file thứ i
	              $_FILES['userfile']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
	              $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
	              $_FILES['userfile']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
	              $_FILES['userfile']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i
	              //load thư viện upload và cấu hình
	              $this->CI->load->library('upload', $config);
	              //thực hiện upload từng file
	              if($this->CI->upload->do_upload())
	              {
	                  //nếu upload thành công thì lưu toàn bộ dữ liệu
	                  $data = $this->CI->upload->data();
	                  //in cấu trúc dữ liệu của các file
	                $image[]=$data['file_name'];
	              }     
	         }
	         return $image;

		}
		// cau hinh upload file
		function config($upload_path=''){
			// khai bao cau hinh
        	// $this->load->library('upload', $config);
			$config=array();
			$config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
			return $config;
		}
	}
?>