<?php 
$this->load->view("admin/head");
$this->load->view("admin/header");
$this->load->view("admin/menu");

?>
<div class="content" >
		<div class="wrapper" id="main_product">
	<div class="widget">
		<div><?php
			if($this->session->flashdata('message')){
				echo $this->session->flashdata('message');
			}
		?></div>
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>
				Loại  sản phẩm	</h6>
		 	<div class="num f12">Số lượng: <b><?php echo(count($lsanpham));?></b></div>
		</div>		
		<div style="clear: both;"></div>
		<div class="contens">
			<form action="<?php echo base_url("admin/Lsanpham/search")?>" method="post">
								
								<label style="margin: 10px;">Danh sách </label>
								<select name="danhmuc">
									<?php foreach ($danhmuc as $row):
										
	 				 				?>
	 				 				<option value="<?php echo $row->id?>"><?php echo $row->Ten?></option>
	 				 				<?php endforeach;?>
									
								</select>
								<input type="submit" name="submit" value="Loc" style="padding:4px; ">
								<input type="button" name="button" value="Reset" style="padding:4px; ">
							</form>
			<table width="100%" style="border-collapse: collapse;">
				
				<thead>
					<tr>
						<td style="width:21px;"><img src="<?php echo base_url("public/Admin/")?>jmg/icon/tableArrows.png" /></td>
						<td>Tên</td>
						<td>Danh mục</td>
						<td>Thao tác</td>
						
					</tr>
			</thead>
			<tbody class="list_item">
			<?php foreach ($lsanpham as $row):
	 				
	 				 ?>
	
			      	<tr class='row_9'>
							<td><input type="checkbox" name="id[]" value="9" /></td>
							
							<td class="textC"><?php echo $row->Ten;?></td>
							
							
							<td class="textName">
								<?php foreach ($danhmuc as $rows):
	 									if($row->id_list==$rows->id):
	 				 			?>
									<h4><?php echo $rows->Ten;?></h4>
									<?php 
										break;
										endif;
									endforeach;
									?>
							</td>
							
							
							
							
							<td class="option textC">
								 <a href="<?php echo base_url("admin/lsanpham/edit/$row->id");?>" title="Chỉnh sửa" class="tipS">
									<img src="<?php echo base_url("public/Admin/")?>jmg/icon/edit.png" />
								</a>
								
								<a href="<?php echo base_url("admin/lsanpham/delete/$row->id");?>" title="Xóa" class="tipS verify_action" >
								    <img src="<?php echo base_url("public/Admin/")?>jmg/icon/delete.png" />
								</a>
							</td>
					</tr>
		
				<?php endforeach;?>
			</table>
			<div class="delete" >
				 <button><a href="#" >Xóa hết</a></button>
			</div>
			<div class="add" >				
				<a href="<?php echo base_url("admin/Lsanpham/add")?>" >
					<img src="<?php echo base_url("public/Admin/")?>jmg/icon/plus.png">
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