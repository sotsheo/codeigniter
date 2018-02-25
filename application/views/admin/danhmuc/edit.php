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
				Edit danh mục sản phẩm 	</h6>
		 	
		</div>		
		<div style="clear: both;"></div>
		<div class="adds">
			<form action="" method="POST" role="form" width="100%">
			<table style="border-collapse: collapse;" width="100%" >
				 
					<tr >
						<td style="width: 200px;">Tên</td>
						<td><input type="text" name="name" placeholder="Nhập tên cho sản phẩm" required="" value="<?php echo($product->Ten)?>"></td>
					</tr>
					
					
					
				
			</table>
				<div class="add" >							
					<input type="submit" name="submit" style="background: #EEE8AA; border: 1px solid #8B4513;" value="UPDATE">								
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