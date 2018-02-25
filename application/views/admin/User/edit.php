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
				Edit khách hàng
			 </h6>
		 	
		</div>		
		<div><?php
			if($this->session->flashdata('message')){
				echo "<span style='color:red;margin-left:30px'>".$this->session->flashdata('message')."</span>";
			}
		?></div>
		<div style="clear: both;"></div>
		<div class="adds">
			<form action="" method="post" role="form" width="100%">
			<table style="border-collapse: collapse;" width="100%" >
				 
					<tr >
						<td style="width: 200px;">Tên khách hàng</td>
						<td>
							<input type="text" name="name" required="" placeholder="Nhập tên khách" value="<?php echo $user->Ten?>">
						</td>
					</tr>

					<tr >
						<td style="width: 200px;">Tuổi</td>
						<td>
							<input type="number" name="age" required="" placeholder="Nhập tuổi khách" value="<?php echo $user->Tuoi?>">
						</td>
					</tr>
					<tr >
						<td style="width: 200px;">Loại khách hàng</td>
						<td>
							<select name="type" style="width:50% ;">
								<?php
									for ($i=0; $i <=2; $i++):
								?>
									<option value="<?php echo $i?>" 
										<?php 
										if($i==$user->Type)
										{
											echo "selected";
										}
										?>>
										<?php if($i==0){
											echo "Khách thường";
										}
										if($i==1){
											echo "Khách tầm trung";
										}
										if($i==2){
											echo "Khách víp";
										} ?>
									</option>
								<?php endfor;?>
							</select>
						</td>
					</tr>
					<tr >
						<td style="width: 200px;">Email</td>
						<td>
							<input type="email" name="email" placeholder="Nhập Email khách hàng" value="<?php echo $user->Email?>">
						</td>
					</tr>
					<tr >
						<td style="width: 200px;">Địa chỉ</td>
						<td>
						<input type="text" name="diachi" required="" placeholder="Nhập địa chỉ khách hàng" value="<?php echo $user->Diachi?>">
						</td>
					</tr>
					<tr >
						<td style="width: 200px;">Điện thoại</td>
						<td>
					<input type="text" name="dienthoai" required="" placeholder="Nhập điện thoại khách hàng" value="<?php echo $user->Dienthoai?>">
						</td>
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
	