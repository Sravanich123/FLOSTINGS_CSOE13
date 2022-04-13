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
        <li><a href="index.php"><i class="fa-solid fa-house">&nbsp;</i>Home</a></li>
        <li><a href="form.php">Form page <i class="fa-solid fa-angle-right icon"></i></a></li>
   </ul>
  <form>
    <div id="search">
        <abbr title="Ctrl+Enter to search">
        <input type="search" id="search_text" placeholder="Search for an item">
        </abbr>
        <a href="index1.php"><i onclick="search()" class="fa-solid fa-arrow-rotate-right"></i></a>
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
                    <a onclick="del('<?php echo $row[5];?>',<?php echo $row[0];?>)"> <i title="Delete if the item was found" style="transform:none;" class="fa-solid fa-trash"></i></a>
                </form>
                
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
<script src=
    "https://smtpjs.com/v3/smtp.js">
  </script>
<script type="text/javascript">
function del(x,y)
{   if(confirm("Do u want to delete the Item?")){
	var otp=Math.floor((Math.random() * 8999) + 1000);
     Email.send({
	SecureToken : "e4064595-4dbb-4d05-ad99-9c3a58e63396",
        To: x,
        From: "flostings@gmail.com",
        Subject: "OTP From Flostings to Delete the Item.",
        Body: "Dear User, your OTP is : "+ otp,
      }).then(
    var user_otp=prompt("OTP has been sent to your mail Id. Enter the OTP:");
    if(user_otp==otp)
    {   
        alert("Item Deleted Successfully.");
	document.getElementById(y).submit(); 
    }
    else
    {           
        alert("Incorrect OTP.");
    });
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





