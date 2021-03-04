<?php
session_start();
//Add db page code come in
include_once('include/db.php');

//Select all item query
$qry = "SELECT * FROM tb_item";
//Connect database
$sql = mysqli_query($conn, $qry);

    if(isset($_POST['submit'])){
                $search=$_POST['select'];
                $qryl="SELECT * FROM  tb_item WHERE $search like'%".$_POST['search_data']."%'";
                $sql=mysqli_query($conn,$qryl);
            }

//check if button delete is click
if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){
	//get the data using $_GET[], inside the $_GET[] is the name on the url
	$id=$_GET['id'];
	//delete user query
	$Query="DELETE FROM tb_item WHERE id='$id'";
	//check if the query run success then messagebox will show
	if($result=mysqli_query($conn,$Query)){
        //go to index page and show a message box
		echo "<script>window.location.href = 'index.php';
			  alert('Record Successfully Delete');
			  </script>";
	//messagebox will show when users fail to delete
	}else{
		echo "<script>alert('Record Fails to Delete')</script>";
	}

}
?>
<!DOCTYPE html>
<html>
<head>

<style>
body{background-image: url("Picture/g.jpg");background-size: cover;}
	table{border-collapse:collapse;width:100%;}




.rainbow-bg{
    animation: rainbow-bg 2.5s linear;
    animation-iteration-count: infinite;
}

.rainbow{
    animation:  2.5s linear;
    animation-iteration-count: infinite;
}

@keyframes rainbow-bg{

    100%{
        border:10px;
    }
  
    8%{
      background-color: rgb(255,127,0);
    }
    16%{
      background-color: rgb(255,255,0);
    }
    25%{
      background-color: rgb(127,255,0);
    }
    33%{
      background-color: rgb(0,255,0);
    }
    41%{
      background-color: rgb(0,255,127);
    }
    50%{
      background-color: rgb(0,255,255);
    }
    58%{
      background-color: rgb(0,127,255);
    }
    66%{
      background-color: rgb(0,0,255);
    }
    75%{
      background-color: rgb(127,0,255);
    }
    83%{
      background-color: rgb(255,0,255);
    }
    91%{
      background-color: rgb(255,0,127);
    }
}

@keyframes rainbow{
    100%,0%{
      color: rgb(255,0,0);
    }
    8%{
      color: rgb(255,127,0);
    }
    16%{
      color: rgb(255,255,0);
    }
    25%{
      color: rgb(127,255,0);
    }
    33%{
      color: rgb(0,255,0);
    }
    41%{
      color: rgb(0,255,127);
    }
    50%{
      color: rgb(0,255,255);
    }
    58%{
      color: rgb(0,127,255);
    }
    66%{
      color: rgb(0,0,255);
    }
    75%{
      color: rgb(127,0,255);
    }
    83%{
      color: rgb(255,0,255);
    }
    91%{
      color: rgb(255,0,127);
    }
}

button{
	padding: 8px;
	width: 120px;
	font-size: :16px;
	border: 2px solid dodgerblue;
	border-radius: 10px;
	color:white;
	background-color:dodgerblue;
}
button:hover{
	color:dodgerblue;
	background-color: white;
} 
}
    
</style>
<head>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
</head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
    <?php if($_SESSION['permission']=="Seller"){?>

    <button type="button" onclick="window.location.href='add.php'">Add New</button>
    <button type="button" onclick="window.location.href='view_cart_admin.php'">view cart</button>
    <button type="button" onclick="window.location.href='login_page.php'">Log out</button>
    <?php }else{?>
    <button type="button" onclick="window.location.href='login_page.php'">Log out</button>
    <button type="button" onclick="window.location.href='view_cart.php'">view cart</button>
    <?php } ?>
<br>
<br>
<form action="index.php" method="post" enctype="multipart/form-data">    
<div class="block">
</div><br>
    <div>
        <select name="select">
            <option value="SKU">SKu</option>
            <option value="Quantity"> in stock Quantity</option>
            <option value="Price">Price per item</option>
        </select>
        <input type="text" class="empty" placeholder="&#xF002; Search" name="search_data">
        <button type="submit" name="submit" class="button">Submit</button>
        
    </div>
    <div class="container">
<?php
if ($_SESSION['permission']=='Buyer') { ?>  
    <table>
    	<thead class="rainbow-bg">
            <th>Image</th>
            <th>SKU</th>
            <th>Quantity</th>
            <th>Price</th>
            
        </thead>
        <tbody class="rainbow-bg" id="item_table">
        <?php while($row = mysqli_fetch_array($sql)){?>
            <tr>

                <td><img src="<?=$row['image']?>" style="width: 100px;height: 100px;" ></td>
            	<td><?=$row['SKU']?></td>
            	<td><?=$row['Quantity']?></td>
            	<td>RM <?=$row['Price']?></td>
            	
            	
            </tr>
        <?php }?>
        </tbody>
    </table>
    <?php }else{?>
    <table>
        <thead class="rainbow-bg">
            <th>Image</th>
            <th>SKU</th>
            <th>Price</th>
            <th>Action</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody class="rainbow-bg" id="item_table">
        <?php while($row = mysqli_fetch_array($sql)){?>
            <tr>

                <td><img src="<?=$row['image']?>" style="width: 100px;height: 100px;" ></td>
                <td><?=$row['SKU']?></td>
                <td>RM <?=$row['Price']?></td>
                <td>
                    <button type="button" onclick="window.location.href='cart.php?Id=<?=$row['Id']?>'">Buy</button>
                </td>
                <td>
                    <button type="button" onclick="window.location.href='edit.php?id=<?=$row['id']?>'">Edit</button>
                </td>
                <td>
                    <a href="index.php?id=<?=$row['id']?>&action=delete" onclick="return confirm('Are you sure you want to Delete?');">
                        <button type="button">Delete</button>
                    </a>
                </td>
            </tr>
                     <?php }?>
        </tbody>
    </table>
    <?php }?>
</body>
</div>
</form>

<script>
            $(document).ready(function(){
                $('#search').keyup(function(){
                    search_table($(this).val());

                }); 
            
            function search_table(value){
                $('#employee_table tr').each(function(){
                    var found='false';
                    $(this).each(function(){
                        if($(this).text().toLowerCase().indexOf(value.toLowerCase())>=0)
                                {
                                    found='true';
                                
                                }
                });
                if(found=='true'){
                    $(this).show();

                }else{
                    $(this).hide();
                }
            });
            }
        });
        </script>
</body>
</head>
</html>