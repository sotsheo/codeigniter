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
				Khách hàng	</h6>
		 	<div class="num f12">Số lượng: <b><?php echo(count($user));?></b></div>
		</div>		
		<div style="clear: both;"></div>
		<div class="contens">
			<form action="" method="post">
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
						<td style="width:150px;">Tên khách</td>
						<td style="width:150px;">Tuổi</td>
						<td style="width:150px;">Loại khách hàng</td>
						<td style="width:100px;">Email</td>
						<td style="width:75px;">Địa chỉ</td>
						<td style="width:75px;">Điện thoại</td>
						<td style="width:120px;">Hành động</td>
					</tr>
			</thead>
			<tbody class="list_item">
				<?php
					foreach ($user as $row ):
				?>

			      	<tr class='row_9'>
							<td><input type="checkbox" name="id[]" value="9" /></td>
							
							 <td class="textC">
							 	<h4>
									<?php
										echo $row->Ten;
									?>
									
								</h4>
							 </td>
							
							<td class="textName">
								<h4>
									<?php
										echo $row->Tuoi;
									?>
									
								</h4>
							</td>
							<td class="textName">
								<h4>
									<?php
										if($row->Type==0){
											echo "Khách thường";
										}
										if($row->Type==1){
											echo "Khách tầm trung";
										}
										if($row->Type==2){
											echo "Khách víp";
										}
									?>
								</h4>
							</td>
							
							<td class="textR"><?php echo $row->Email; ?>
		                           				
							</td>
							<td class="textR"><?php echo $row->Diachi ; ?>
		                           				
							</td>
							<td class="textC"><?php echo $row->Dienthoai ; ?></td>
							</td>
							
							
							<td class="option textC">
								 <a href="<?php echo base_url("admin/User/edit/$row->id")?>" title="Chỉnh sửa" class="tipS">
									<img src="<?php echo base_url("public/Admin/")?>jmg/icon/edit.png" />
								</a>
								
								<a href="<?php echo base_url("admin/User/delete/$row->id")?>" title="Xóa" class="tipS verify_action" >
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
			<div class="add"  >
				<a href="<?php echo base_url("admin/User/add")?>" style="display: inline-block;">
					<img src="<?php echo base_url("public/Admin/")?>jmg/icon/plus.png">
					<span>Thêm khách hàng</span>
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