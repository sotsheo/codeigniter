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
				Edit sản phẩm		</h6>
		 	
		</div>		
		<div style="clear: both;"></div>
		<div class="adds">
			<form action="" method="POST" role="form" width="100%" enctype='multipart/form-data'>
			<table style="border-collapse: collapse;" width="100%" >
				 
					<tr >
						<td style="width: 200px;">Tên</td>
						<td><input type="text" name="name" placeholder="Nhập tên cho sản phẩm" value="<?php echo $sanpham->Ten?>"></td>
					</tr>
					<tr>
						<td>Ảnh</td>
						<td><input id="file" type="file" name="image"  /><img src="<?php echo base_url("uploads/sanpham/$sanpham->Anh")?>" width="150" height="150"></td>
					</tr>
					<tr >
						<td style="width: 200px;">Giá bán</td>
						<td><input type="number" name="price" placeholder="Nhập giá sản phẩm" value="<?php echo $sanpham->Giaban?>"></td>
					</tr>
					<tr>
						<td>Loại  sản phẩm</td>
					
							<td><select name="lsanpham">
							<?php
						 	foreach ($lsanpham as $row):
						?>
							<option value="<?php echo $row->id ?>" <?php
								if($row->id==$sanpham->id_stypes){
									echo "checked";
								}
							?>><?php echo $row->Ten?></option>
						<?php endforeach;?>
						</td>
					</tr>
					
					<tr>
						<td>Mã</td>
						<td><input type="text" name="ma" required="" placeholder="Nhập mã cho  sản phẩm" maxlength="5" value="<?php echo $sanpham->Ma ?>"></td>
					</tr>
					<tr>
						<td>Khuyến mãi</td>
						<td><input type="text" name="km"  placeholder="Nhập mã cho  sản phẩm" value="<?php echo $sanpham->Khuyenmai ?>"></td>
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