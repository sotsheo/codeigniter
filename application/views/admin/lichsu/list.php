<?php 
$this->load->view("admin/head");
$this->load->view("admin/header");
$this->load->view("admin/menu");

?>
<div class="content" >
		<div class="wrapper" id="main_product">
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>
				Danh mục sản phẩm	</h6>
		 	<div class="num f12">Số lượng: <b><?php echo(count($lichsus));?></b></div>
		</div>		
		<div style="clear: both;"></div>
		<div class="contens">
			<form action="<?php echo base_url("admin/Lichsu/search")?>" method="post">
								
								<label style="margin: 10px;">Danh sách </label>
								
								<select name="ls">
									<?php
										
										$mangs=array();
										//echo(count($lichsus));
										//print_r($lichsus);
										$i=0;
										foreach ($lichsus as $row ) {
											$mangs[$i]=substr($lichsus[$i]->Ngay,0,10);		
											$i++;
										}
										$data=array();
										$data[0]=$mangs[0];
										$i=1;
										 foreach ($mangs as $rows) {
											
										 	foreach ($data as $row) {
										 		if($rows!=$row){
										 				$data[$i]=$rows;
												}
										 	}		
													
										}
									
										foreach ($data as $row ):
									?>
										<option value="<?php  echo $row?>"><?php  echo $row?></option>
									<?php									
										
										endforeach;
									?>
									</select>
								
								<input type="submit" name="submit" value="Loc" style="padding:4px; ">
								<input type="button" name="button" value="Reset" style="padding:4px; ">
							</form>
			<table width="100%" style="border-collapse: collapse;">
				
				<thead>
					<tr>
						<td style="width:21px;"><img src="<?php echo base_url("public/Admin/")?>jmg/icon/tableArrows.png" /></td>
						<td>Nội dung</td>
						<td>Ngày</td>
						
						
					</tr>
			</thead>
			<tbody class="list_item">
			<?php foreach ($lichsu as $row):
	 				
	 				 ?>
	
			      	<tr class='row_9'>
							<td><input type="checkbox" name="id[]" value="9" /></td>
							
							<td class="textC"><?php echo $row->Noidung;?></td>
							<td class="textC"><?php echo $row->Ngay;?></td>
							
					</tr>
		
				<?php endforeach;?>
			</table>
			<div class="delete" >
				 <button><a href="#" >Xóa hết</a></button>
			</div>
			<div class="add" >				
				<a href="<?php echo base_url("admin/Lsanpham/add")?>" >
					<img src="<?php echo base_url("public/Admin/")?>jjmg/icon/plus.png">
					<span>Nhập thêm danh mục</span>
				</a>
			</div>
			<div style="clear: both;"></div>
			<div class="pagination">
				<?php echo $this->pagination->create_links()?>
			</div>
		</div>


	</div>
		
	</div>

	</div>