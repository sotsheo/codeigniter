<?php
	Class MY_Controller extends CI_Controller{
		function __construct(){
			parent::__construct();
			$url=$this->uri->segment(1);

			switch($url){
				case 'admin':{
					// kiem tra da dang nhap chua
					$this->check_login1();

					//echo $url;
					break;
				}
				default :{

				}
			}
		}
		function check_login1(){
			$login=$this->session->userdata('Login');
			$url=$this->uri->segment(2);		
			if(!$login && $url !='Login'){	
				redirect(base_url("admin/Login"));				
			}
			if($login && $url=='Login'){
				redirect(base_url("admin/Home"));
			}
		}

	}
?>