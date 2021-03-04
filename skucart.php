<?php
include_once('include/db.php.php');
$query="SELECT * FROM tb_checkout WHERE User_ID='".$_SESSION['User_ID']."'";
if ($sql = mysqli_query($conn,$query)) {
  $checkqry = "SELECT sum(Amount)FROM tb_checkout WHERE User_ID = '".$_SESSION['User_ID']."'";
  $result2 = mysqli_query($conn,$checkqry);
  $Amount= mysqli_fetch_array($result2);
}

//Delete Data (Check if button is click)
if(isset($_GET['ID'])&& isset($_GET['action']) && $_GET['action']=='delete'){
  //get the data using $_Get(],inside the $_Get[] is the name on the URL
  $ID=$_GET['ID'];
  //delete user query
  $query="DELETE FROM tb_cart WHERE ID='$ID'";
  if($result=mysqli_query($conn,$query)){
    echo"<script>window.location.href='skucart.php';
    alert('Item has been removed from shopping cart');</script>";
  //Message box will show users fail to delete
  }else{
    echo"<script>alert('Item cannot be removed from shopping cart')</script>";
    }
  } 

//check the button PROCEED TO CHECKOUT is click
  if(isset($_POST['add'])){
  //Get the data using $_POST[], inside the $_POST[] is the name inside the input tag
  $Name=$_POST['Name'];
  $Address=$_POST['Address'];
  $Amount=$_POST['Amount'];
  $Phone=$_POST['Phone'];    
  $User_ID=$_SESSION['User_ID'];
  //add to checkout table
  $Query="INSERT INTO tb_checkout(Name,Address,Amount,Payment,Phone,User_ID) VALUES ('$Name','$Address','$Amount','UNPAID','$Phone','$User_ID')";
  //check if the query run success then messagebox will show, item of cart will delete automatically
  if($result=mysqli_query($conn,$Query)){
    //$qry2="DELETE FROM tb_cart WHERE User_ID='".$_SESSION['User_ID']."'";
    //if($result=mysqli_query($conn,$qry2)){
        echo "<script> window.location.href ='receipt.php';
        alert('Checkout Sucessfully');</script>";
      }
  //messagebox will show when users fail to edit
  }else{
    echo "<script>alert('Checkout Failed)</script>";
  }

//}
?>

<!DOCTYPE>
<html>
<head>
  <title>iShop - Shopping Cart</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div style="position: fixed; width: 100%;">
  <ul>
    <li><a><i class="fa fa-shopping-bag"></i> iShop</a></li>
    <li><a id="currentTime" style="color: cyan;"></a></li>
    <li style="float:right"><a style="color: yellow;"><i class="fa fa-user"></i> <?=$_SESSION['Name']?>'s Shopping Cart</a></li>
  </ul>
  <ul> 
    <li><a class="a" href="skuuser.php"><i class="fa fa-arrow-left" style="color: yellow;"></i> Back to Shop</a></li>
    <li style="float: right;margin-right: 1%;">
      <input type="text" class="search" name="search" id="search"  placeholder="  Search in cart..."></a></li>
  </ul>
</div> 

<br><br/> 

<div class="contains" style="margin-top: 10%;">
    <table>
      <thead>
       <th>Image</th>
       <th>Item Name</th>
       <th>Unit Price</th>
       <th>Quantity</th>
       <th>Amount</th>
       <th>Remove</th>
      </thead>

      <tbody class="table table-bordered" id="employee_table">
        <?php while($row=mysqli_fetch_array($sql)){?>
        <tr>
            <td><center><img src="<?=$row['Image']?>" style="width:150px; height:100px;"></center></td>
            <td><center><?=$row['Item']?></center></td>
            <td><center>RM <?=$row['Price']?></center></td>
            <td><center><?=$row['Quantity']?></center></td>
            <td><center>RM <?=$row['Amount']?></center></td>
            <td><center><a href="skucart.php?ID=<?=$row['ID']?>&action=delete" onclick="return confirm('Do you want to remove this product from the shopping cart?');">
              <button type="button" class="btn1"><i class="fa fa-trash-o"></i></button>
              </a>
            </td>
        </tr>
      <?php }?>
        <tr>
          <td colspan="4" style="text-align: right;">Sub-Total:</td>
          <td colspan="2" style="text-align: center; font-size: 25px;">RM <?php echo $Amount['sum(Amount)']*0.90;?></td>
        </tr>
        <tr>
          <td colspan="4" style="text-align: right;">Service Tax @ 6%:</td>
          <td colspan="2" style="text-align: center; font-size: 25px;">RM <?php echo $Amount['sum(Amount)']*0.06;?></td>
        </tr>
        <tr>
          <td colspan="4" style="text-align: right;">Delivery Fee @ 4%:</td>
          <td colspan="2" style="text-align: center; font-size: 25px;">RM <?php echo $Amount['sum(Amount)']*0.04;?></td>
        </tr>
        <tr>
          <td colspan="4" style="text-align: right; font-weight: bold;">Total Amount:</td>
          <td colspan="2" style="text-align: center; font-weight: bold;font-size: 30px;">RM <?php echo $Amount['sum(Amount)']*1;?>.00</td>
        </tr>
        <tr>
          <td colspan="6" style="text-align: left;">
            <form class="form horizontal" action="skucart.php" method="post" enctype="multipart/form-data">
              <div style="margin-left: 5%;">
                <h1>Fill the delivery form to complete the process</h1>
                <br><br/> 

                <div class="control_group">
                  <label>Receiver Name:</label><br>
                  <input type="text" name="Name" placeholder="What is your name?" value="<?=$_SESSION['Name']?>" required>
                </div>

                <br><br/>

                <div class="control_group">
                  <label>Delivery Address:</label><br>
                  <textarea type="text" name="Address" placeholder=" Send to this location" required></textarea>
                </div>

                <br><br/>

                <div class="control_group">
                  <label>Grand Amount:</label><br>
                  <input type="text" name="Amount" placeholder="None" value="RM <?php echo $Amount['sum(Amount)'];?>" readonly>
                </div>

                <br></br/>

                <div class="control_group">
                  <label>Contact Number:</label><br>
                  <input type="text" name="Phone" value="+60 1" required>
                </div>

                <br><br/>

                <p style="font-size: 20px;">We will deliver your items to your destination as soon as possible (ASAP).</p>
          </td>
        </tr> 
      </div>
      </tbody>
    </table>

    <br></br/>
    <button type="submit" name="add" class="btn2" onclick="return confirm('Do you want proceed to checkout now?');">Proceed to <b>Checkout</b></button></a>
</form>
</div>
<br><br/>
<center><p>© 2019 iShop Corp. All rights reserved.</p></center>

</body>
</html>

<!--Search Info From Table-->
<script>  
      $(document).ready(function(){  
           $('#search').keyup(function(){  
                search_table($(this).val());  
           });  
           function search_table(value){  
                $('#employee_table tr').each(function(){  
                     var found = 'false';  
                     $(this).each(function(){  
                          if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
                          {  
                               found = 'true';  
                          }  
                     });  
                     if(found == 'true')  
                     {  
                          $(this).show();  
                     }  
                     else  
                     {  
                          $(this).hide();
                     }  
                });  
           }  
      });  
</script> 

<script> /*Timer*/
// https://codepen.io/jaystephens3/pen/qoKgn 
// https://www.w3schools.com/js/tryit.asp?filename=tryjs_timing_clock 
window.onload = function() {
  clock();  
    function clock() {
    var now = new Date();
    var TwentyFourHour = now.getHours();
    var hour = now.getHours();
    var min = now.getMinutes();
    var sec = now.getSeconds();
    sec = checkTime(sec);
    var mid = 'pm';
    if (min < 10) {
      min = "0" + min;
    }
    if (hour > 12) {
      hour = hour - 12;
    }    
    if(hour==0){ 
      hour=12;
    }
    if(TwentyFourHour < 12) {
       mid = 'am';
    }     
  function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
  }
  document.getElementById('currentTime').innerHTML =     hour+':'+min+':'+sec +' '+mid ;
    setTimeout(clock, 1000);
    }
}
</script>

<style>
  body {
    background: linear-gradient(to bottom, lightcyan 75%, cyan 100%);
  }

  h1 {
    font-family: Arial;
    font-size:25px;
    color: crimson;
  }

  p {
    font-family: Arial;
    font-size:16px;
    color: black;
  }

  table { 
    border-collapse: collapse;
    width: 80%;
    margin-left: 10%;
  }

  th {
    text-align: center;
    padding: 10px;
    font-family: Arial;
    font-size: 18px;
    font-weight: normal;
    color: dodgerblue;
    background-color: transparent;
    border: 2px solid dodgerblue;
  }

  td {
    text-align: center;
    padding: 10px;
    font-family: Arial;
    font-size: 18px;
    color: black;
    background-color: transparent;
    border: 2px solid dodgerblue;
  }

  .container { 
    margin-left: 10%;
    margin-top: 2%;
    border: solid crimson;
    background: white;
    color: black;
    border-radius: 100px 10px;
    padding: 50px;
    padding-top: 10px;
    padding-bottom: 5px;
    width: 600px;
    height: 550px;
    box-shadow: none; 
    opacity: 1.0;
    font-weight: normal;
  } 

  .search { /*Search Input*/
    font-size:18px;
    padding:5px 5px;
    background-color: white;
    width: 400px;
    color: black;
    border: 2px solid crimson;
    border-radius: 20px;
    margin-top: 1.5%;
  }

  .control_group {
    font-family: Arial;
    font-size:18px;
    color: crimson;
  }

  input { /*Checkout Required Form*/
    font-size:18px;
    padding:5px 5px;
    background-color: transparent;
    width: 300px;
    color: black;
    border: none;
    border-bottom: 2px solid crimson;
    border-radius: 5px;
    margin-left: 0;
  }

  textarea { /*Checkout Address*/
    width: 500px;
    height: 60px;
    border: 2px solid crimson;
    border-radius: 5px;
    resize: none;
    color: black;
    background-color: transparent;
  }

  .btn1 { /*Remove Item*/
    font-size: 30px;
    background-color: red;
    color: white;
    padding: 10px;
    border: 2px solid red;
    border-radius: 50%;
    width: 50%;
  }

  .btn1:hover { /*Remove Item*/
    background-color: white;
    color: red;

  }
  .btn2 { /*Checkout*/
    font-size: 18px;
    background-color: dodgerblue;
    color: white;
    padding: 10px;
    border: 2px solid dodgerblue;
    border-radius: 30px;
    width: 25%;
    margin-left: 65%;
  }

  .btn2:hover { /*Checkout*/
    border-color: dodgerblue;
    background-color: cyan;
    color: blue;
  } 

  ul { /*Top Bar Navigation*/
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: crimson; 
  }

  li {
    float: left;
  }

  li a {  /*Upper Deck*/
    font-size: 30px;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
  }

  li a:hover {  /*Upper Deck*/
    text-decoration: none;
    color: white;
    background-color: crimson;
  }

  li .a { /*Lower Deck*/
    color: white;
    font-weight: bold;
    font-size: 20px;
  }

  li .a:hover { /*Lower Deck*/
    text-decoration: none;
    color: crimson;
    background-color: white;
  }
</style>