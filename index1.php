<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8f186daecf.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="src/f.png">
    <title>Items Page</title>
    <link rel="stylesheet" href="admin_page.css">
</head>

<body> 
    <ul>
        <li><a class="nav-items"  href="index.php"><i class="fa-solid fa-house">&nbsp;</i>Home</a></li>
        <li><a class="nav-items" href="form.php">Form page<i class="fa-solid fa-angle-right icon"></i></a></li>
   </ul>
  <form>
    <div id="search">
        <abbr title="Ctrl+Enter to search">
        <input type="search" id="search_text" placeholder="Search for an item">
        </abbr>
        <a id="search_arrow" href="index1.php"><i id="search_symbol" onclick="search()" class="fa-solid fa-arrow-rotate-right"></i></a>
    </div>
  </form>   

<div class="event-card--conatiner" id="output">

    <?php
         include 'db.php';
    $query = "SELECT * FROM Images ORDER BY Found_on DESC";
    $result = pg_query($con, $query); 
    if (pg_num_rows($result)>0)
    {
      while ($row = pg_fetch_row($result)) {   
    ?>

    <section class="record">
        <div id="record1" class="record-display" >
            <img src="<?php echo $row[4];?>" style="width:230px;height:290px;object-fit:fill;" alt="image"/>
            <div class="btn" style="display:flex; justify-content:space-around;">
                <a href = "mailto:<?php echo $row[5];?>">CONTACT</a>
                <form id="<?php echo $row[0];?>" action="del.php" method="post">
                    <input style="display:none;" type="number" name="id" value="<?php echo $row[0];?>">
                </form>
                <a onclick="del('<?php echo $row[5];?>',<?php echo $row[0];?>)"> <i title="Delete if the item was found" style="transform:none;" class="fa-solid fa-trash"></i></a>
            </div>
        </div>
        <div class="record-desc">
            <div id="detail">
                <h1>DETAILS</h1>
                <p><b>Item: </b><?php echo $row[1];?><br>
                <b>Found at: </b> <?php echo $row[2];?><br>
                <b>Found on: </b><?php echo $row[3];?><br>
                <b>Mob no: &nbsp;</b><?php echo $row[6];?><br>
                </p>
            <div>
        </div>
    </section>
      <?php }}?>
</div>
<div id="bg" style="visibility:hidden; background:rgb(57,43,87); width:100%;height:100%; position:absolute; opacity:80%;top:0;"></div>
    <div id="otppopup">
    <div id="headings" style="display:flex;">
        <a style="font-size: 17.5px;float:left; color:rgb(57,43,87);" id="otp">OTP has been sent to the uploader's email address.</a>
        <i style="float:right;" onclick="closeform()" class="close">&times</i>
    </div><br>  
    <input class="input-box" id="otp1" name="otp1" type="number" placeholder="Enter the OTP">
    <small id="incorrectotp" style="color:red;"></small>
    <button id="otpverify" onclick="otpverify()">Verify</button>
    </div>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script type="text/javascript">
    var otp,user_otp,item_id;
	function del(x,y)
    {   item_id=y;
        if(confirm("Do u want to delete the Item?")){
	    otp=Math.floor((Math.random() * 8999) + 1000);
        Email.send({
	    SecureToken : "e4064595-4dbb-4d05-ad99-9c3a58e63396",
        To: x,
        From: "flostings@gmail.com",
        Subject: "OTP From Flostings to Delete the Item.",
        Body: "Dear User, your OTP is : "+ otp,
      });
    document.getElementById('otppopup').style.visibility='visible';
    document.getElementById('bg').style.visibility='visible';
   }
   }
   function closeform()
    {   
            document.getElementById('otppopup').style.visibility='hidden';
            document.getElementById('bg').style.visibility='hidden';
            document.getElementById('incorrectotp').innerHTML='';
    }
    function otpverify()
    {   
        user_otp=document.getElementById("otp1").value;
        if(user_otp!=otp){
            document.getElementById('incorrectotp').innerHTML='Incorrect OTP' +'<br><br>';
        }
        else{
            document.getElementById('incorrectotp').innerHTML='';
            document.getElementById('incorrectotp').style.color='green';
            document.getElementById('incorrectotp').innerHTML='Deleting the Item..'+'<br><br>';
            document.getElementById(item_id).submit();
        }    
    }
  $(document).ready(function(){
      $("#search_text").keypress(function(){
          $.ajax({
              type:'POST',
              url:'search.php',
              data:{
                  name:$("#search_text").val(),
              },
              success:function(data){
                $("#output").html(data);
              }
          });
      });
  });
</script>
    
</body>
</html>





