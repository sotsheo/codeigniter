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
				Danh sách sản phẩm			</h6>
		 	<div class="num f12">Số lượng: <b>0</b></div>
		</div>		
		<div style="clear: both;"></div>
		<div class="contens">
			<form action="" method="post" enctype='multipart/form-data'>
								<label style="margin: 10px;">Tên sản phẩm</label>
								<input type="tex" name="name" placeholder="Nhap ten san pham" style="padding: 4px;">
								<label style="margin: 10px;">Danh sách </label><select>
									<optgroup label="Tv">
										<option value="LG">LG</option>
										<option value="Samsung">SamSung</option>
									</optgroup>
									
								</select>
								<input type="submit" name="submit" value="Loc" style="padding:4px; ">
								<input type="button" name="button" value="Reset" style="padding:4px; ">
							</form>
			<table width="100%" style="border-collapse: collapse;">
				
				<thead>
					<tr>
						<td style="width:21px;"><img src="<?php echo base_url("public/Admin/")?>jmg/icon/tableArrows.png" /></td>
						<td style="width:60px;">Mã số</td>
						<td>Tên</td>
						<td style="width:150px;">Ảnh</td>
						<td style="width:100px;">Giá bán</td>
						<td style="width:100px;">Số lượng</td>
						<td style="width:75px;">Khuyến mãi</td>
						<td style="width:75px;">Mã</td>
						<td style="width:120px;">Hành động</td>
					</tr>
			</thead>
			<tbody class="list_item">

				<?php
					foreach ($list as $row):
				 ?>
			      	<tr class='row_9'>
							<td><input type="checkbox" name="id[]" value="9" /></td>
							
							<td class="textC"><?php echo $row->id?></td>
							
							<td class="textName">
								<h4><?php echo $row->Ten?></h4>
							</td>
							<td class="textImg">
								<img src="<?php echo base_url("public/Admin/")?>jmg/icon/edit.png" />
							</td>
							
							<td class="textR"><?php echo $row->Giaban?>
		                           				
							</td>
							<td class="textR"><?php echo $row->Soluongban?>
		                           				
							</td>
							<td class="textC"><?php echo $row->Khuyenmai?></td>
							</td>
							</td>
							<td class="textC"><?php echo $row->Ma?></td>
							</td>
							
							
							<td class="option textC">
								 <a href="admin/product/edit/9.html" title="Chỉnh sửa" class="tipS">
									<img src="<?php echo base_url("public/Admin/")?>jmg/icon/edit.png" />
								</a>
								
								<a href="admin/product/del/9.html" title="Xóa" class="tipS verify_action" >
								    <img src="<?php echo base_url("public/Admin/")?>jmg/icon/delete.png" />
								</a>
							</td>
					</tr>
				<?php
					endforeach;
				 ?>
				</tbody>
				
			</table>
			<div class="delete" >
				 <button><a href="#" >Xóa hết</a></button>
			</div>
			<div class="add" >
				<a href="<?php echo base_url("admin/sanpham/add")?>">
					<img src="<?php echo base_url("public/Admin/")?>jmg/icon/plus.png">
					<span>Thêm mới</span>
				</a>
			</div>
			<div style="clear: both;"></div>

		</div>


	</div>
		
	</div>

	</div>