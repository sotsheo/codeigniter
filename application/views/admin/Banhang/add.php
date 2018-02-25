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
				Bán sản phẩm </h6>
		 	
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
						<td style="width: 200px;">Mã sản phẩm</td>
						<td>
							<select name="sanpham" style="width:50% ;">
								<?php
									foreach ($sanpham as $row ):
								?>
									<option value="<?php echo $row->id?>"><?php echo $row->Ma?></option>
								<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr >
						<td style="width: 200px;">Tên khách hàng</td>
						<td>
							<select name="khach" style="width:50% ;">
								<?php
									foreach ($khach as $row ):
								?>
									<option value="<?php echo $row->id?>"><?php echo $row->Ten?></option>
								<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr >
						<td style="width: 200px;">Số lượng bán</td>
						<td>
							<input type="number" name="soluong" required="">
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
	<script type="text/javascript">
		$(document).ready(function(){			
			document.getElementById('file').onchange = function() {
	   		var fileInput = document.getElementById('file');
				var filePath = fileInput.value;//lấy giá trị input theo id
				var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;//các tập tin cho phép
				//Kiểm tra định dạng
				if(!allowedExtensions.exec(filePath)){
				alert('Vui lòng upload các file có định dạng: .jpeg/.jpg/.png/.gif only.');
				fileInput.value = '';
				return false;
				}else{
				//Image preview
				if (fileInput.files && fileInput.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {      
					
				};
				reader.readAsDataURL(fileInput.files[0]);
				}
			}
		};
		
		});
		
		
	</script>