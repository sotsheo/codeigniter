<?php 
$this->load->view("admin/head");
$this->load->view("admin/header");
$this->load->view("admin/menu");

?>
<div class="content" >
		<div class="wrapper" id="main_product">
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><img src="<?php echo base_url("public/Admin/")?>jmg/icon/plus.png"></span>
			<h6>
				Edit nhập sản phẩm		</h6>
		 	
		</div>		
		<div style="clear: both;"></div>
		<div class="adds">
			<form action="" method="POST" role="form" width="100%" enctype='multipart/form-data'>
			<table style="border-collapse: collapse;" width="100%" >
				 
					<tr >
						<td style="width: 200px;">Tên sản phẩm</td>
						
						<td>
							<select name="sanpham">
									<?php
										foreach ($sanpham as $row):
											if($row->id==$nhapsanpham->id_sanpham):
									?>
										<option value="<?php echo $row->id?>" checked><?php echo $row->Ten;?></option>
									<?php
										endif;
										endforeach;
									?>
							</select>
						
						</td>
					
					<tr >
						<td style="width: 200px;">Giá nhập</td>
						<td><input type="number" name="price" placeholder="Nhập giá sản phẩm" value="<?php echo $nhapsanpham->Gianhap?>"></td>
					</tr>
					
					
					<tr>
						<td>Số lượng</td>
						<td><input type="number" name="sl" required="" placeholder="Nhập số lượng " maxlength="5" value="<?php echo $nhapsanpham->soluong?>"></td>
					</tr>
					
					
				
			</table>
				<div class="add" >							
					<input type="submit" name="submit" style="background: #EEE8AA; border: 1px solid #8B4513;">								
				</div>
				<div style="clear: both;"></div>
			</form>
		</div>
		
	</div>

	</div>
	