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
				Lịch sử nhập hàng	</h6>
		 	<div class="num f12">Số lượng: <b><?php echo(count($xuathang));?></b></div>
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
						<td style="width:150px;">Tên sản phẩm</td>
						<td style="width:150px;">Tên người khách</td>
						<td style="width:150px;">Tên người bán</td>
						<td style="width:100px;">Số lượng</td>
						<td style="width:75px;">Ngày bán</td>
						<td style="width:75px;">Tổng tiền</td>
						<td style="width:120px;">Hành động</td>
					</tr>
			</thead>
			<tbody class="list_item">
				<?php
					foreach ($xuathang as $row ):
				?>

			      	<tr class='row_9'>
							<td><input type="checkbox" name="id[]" value="9" /></td>
							
							 <td class="textC">
							 	<h4>
									<?php
									 foreach ($sanpham as $id_admin ): ?>
										<?php
											 if($id_admin->id==$row->id_sanpham){
											 	echo $id_admin->Ten;
											 }
										?>
									<?php  endforeach; ?>
									
								</h4>
							 </td>
							
							<td class="textName">
								<h4>
									<?php
									//print_r($row->id_khach);
									 foreach ($khach as $id_khach ): ?>
										<?php
											 if($id_khach->id==$row->id_khach){
											 	echo $id_khach->Ten;
											 }
										?>
									<?php  endforeach; ?>
									
								</h4>
							</td>
							<td class="textName">
								<h4>
									<?php 
									foreach ($admin as $k ): ?>
										<?php
											 if($k->id==$row->id_admin){
											 	echo $k->Username;
											 }
										?>
									<?php endforeach; ?>
								</h4>
							</td>
							
							<td class="textR"><?php echo $row->soluong; ?>
		                           				
							</td>
							<td class="textR"><?php echo $row->Ngayban ; ?>
		                           				
							</td>
							<td class="textC"><?php echo $row->Tongtien ; ?></td>
							</td>
							
							
							<td class="option textC">
								 <a href="<?php echo base_url("admin/Nhaphang/edit/$row->id")?>" title="Chỉnh sửa" class="tipS">
									<img src="<?php echo base_url("public/Admin/")?>jmg/icon/edit.png" />
								</a>
								
								<a href="<?php echo base_url("admin/Nhaphang/delete/$row->id")?>" title="Xóa" class="tipS verify_action" >
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
				<a href="<?php echo base_url("admin/Banhang/add")?>" style="display: inline-block;">
					<img src="<?php echo base_url("public/Admin/")?>jmg/icon/plus.png">
					<span>Bán hàng</span>
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