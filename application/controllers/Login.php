<?php
	 Class Login extends MY_Controller{
	 	function __construct(){
	 		parent::__construct();
	 	}
	 	public function index(){	 						
			redirect(base_url("admin/Login"));					
	 	}
	 	
	 	
	 }
?>