<?php
	Class MY_Model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		// tao bang 
		public $table="";
		public $id="id";
		public $order='';
		// insert du lieu($data)
		function insert($data=''){
			if($this->db->insert($this->table,$data)){
				return true;
			}
			return false;
		}
		// ham where ($this->db->where($where))
		function where($where=array()){
			if(!$where){
				return false;
			}
			if($this->db->where($where)){
				return true;
			}			
				return false;

		}
		// update ($where,$data)
		function update($where,$data=''){
			if($this->where($where)){
				$this->db->update($this->table,$data);
					return true;
				
			}
			return false;
		}
		// delete ($where)
		function dele($where){
			if($this->where($where)){
				$this->db->delete($this->table);
					return true;
				
			}
			return false;
		}
		// ham kiem tra ton tai ($where)
		function exists($where){
			if($this->db->where($where)){
				$query=$this->db->get($this->table);
				if($query->num_rows()>0){
					return true;
				}
			}
			return false;

		}
		// Sap xep Where,order_by,limit,like
		function get_list_expand($input=''){
			// where
			if(isset($input['where']) && $input['where']){
				$this->db->where($input['where']);
			}
			// like
			if(isset($input['like']) && $input['like']){
				$this->db->like($input['like']);
			}
			// order
			if(isset($input['order'])){
				$this->db->order($input['order'][0],$input['order'][1]);
			}
			else{
				$order=($this->order=='')?array($this->table.'.'.$this->id,'desc'):$this->order;
				$this->db->order_by($order[0],$order[1]);
			}
			//limit
			if(isset($input['limit']) && $input['limit']){
				$this->db->limit($input['limit'][0],$input['limit'][1]);
			}
		}
		// lay danh sach du lieu
		function get_lists($where=''){
			$this->get_list_expand($where);
			$query=$this->db->get($this->table);
			return $query->result();
		}
		// lay 1 dong duy nhat
		function query($where=array(),$query=''){
			if($query){
				$this->db->select($query);
			}
			$this->where($where);
			$query=$this->db->get($this->table);
			// kiem tra so luong tra ve
			if($query->num_rows()){
				return $query->row();
			}
			return false;
		}
		/**
		 * Lay tong so
		 */
		function get_total($input = array())
		{
			$this->get_list_expand($input);
			
			$query = $this->db->get($this->table);
			
			return $query->num_rows();
		}
		
		/**
		 * Lay tong so
		 * $field: cot muon tinh tong
		 */
		function get_sum($field, $where = array())
		{
			$this->db->select_sum($field);//tinh rong
			$this->db->where($where);//dieu kien
			$this->db->from($this->table);
			
			$row = $this->db->get()->row();
			foreach ($row as $f => $v)
			{
				$sum = $v;
			}
			return $sum;
		}
		function get_info($id, $field = '')
		{
			if (!$id)
			{
				return FALSE;
			}
		 	
		 	$where = array();
		 	$where[$this->id] = $id;
		 	
		 	return $this->get_info_rule($where, $field);
		}
		/**
	 * Lay thong tin cua row tu dieu kien
	 * $where: Mảng điều kiện
	 * $field: Cột muốn lấy dữ liệu
	 */
		function get_info_rule($where = array(), $field= '')
		{
		    if($field)
		    {
		        $this->db->select($field);
		    }
			$this->db->where($where);
			$query = $this->db->get($this->table);
			if ($query->num_rows())
			{
				return $query->row();
			}
			
			return FALSE;
		}
		/**
	 * Lay thong tin cua row tu dieu kien
	 * $where: Mảng điều kiện
	 * $field: Cột muốn lấy dữ liệu
	 */
		function get_max_id(){
			$this->db->select_max("id");
			$query  = $this->db->get($this->table);
			return   $query->row_array();
		}
	}
?>