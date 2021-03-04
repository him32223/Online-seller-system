<?php
//Add db page code come in
include_once('include/db.php');

//check if button add is click
if (isset($_POST['add'])) {
	//if image is not empty
	if(!empty($_FILES['image']['name']))
	{	
		//take the image extensions
		$ext = explode('.', $_FILES['image']['name']);
		//change the extensions to lower cases
		$ext = strtolower(array_pop($ext));
		//set the image path and name
		$file = 'img/'.date('YmdHis').'.'.$ext;
		//check the extension type
		if(($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'  || )){ 
			$target_path = $file;
		}else{
			$error_ext = 1;
		}
		//check the file is exists in img folder or not
		if(file_exists($file)){
			$file_exists = 1;
		}
	}
	if(isset($error_ext)){
		echo "<script>alert('Please upload .jpg, .jpeg or .png file only.')</script>"; 
	}elseif(isset($file_exists)){
		echo "<script>alert('Image already exists, please choose another image or change the image name.')</script>"; 
	}elseif(isset($target_path) && !move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
		echo "<script>alert('Image failed to upload image')</script>";  
	}else{
		//get the data using $_POST[], inside the $_POST[] is the name inside the input tag
		$image=$file;
		$sku=$_POST['sku'];
		$quantity=$_POST['quantity'];
		$price=$_POST['price'];

		//insert item query
		$qry="INSERT INTO tb_item (image,SKU,Quantity,Price)VALUES('$image','$sku','$quantity','$price')";
		//check if the query run success then messagebox will show
		if ($result=mysqli_query($conn,$qry)) {
			echo "<script>window.location.href = 'index.php';
			alert('Successfully Add.');</script>";
		//messagebox will show when users fail to edit
		}else{
			echo "<script>window.location.href = 'add.php';
			alert('Failed Add.');</script>";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="add.php" method="post" enctype="multipart/form-data">
	<div>
		<label>Image</label><br>
		<input type="file" name="image" value="" onchange="loadfile(event)"><br>
		<img id="output" style="display: none;" width="20%" height="20%"/>
	</div>
	<div>
		<label>SKU</label><br>
		<input type="text" name="sku">
	</div>
	<div>
		<label>Quantity</label><br>
		<input type="number" name="quantity">
	</div>
	<div>
		<label>Price:RM</label><br>
		<input type="number" name="price">
	</div>
	<div><br>
		<input type="submit" name="add" value="Sumbit">
		<input type="button" name="back" value="back" onclick="window.location.href='index.php'">
	</div>
	
</form>
</body>
</html>
<script>
	var loadfile= function(event){
		var output=document.getElementById('output');
		output.src=URL.createObjectURL(event.target.files[0]);
		output.style.display='block';
	}
</script>