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
{   
    Email.send({
        Host: "smtp.elasticemail.com",
	    Username : "flostings@gmail.com",
	    Password : "ACA4099A2181D04E5645716471CB447323A3",
        To: 'bhanavav0407@gmail.com',
        From: "flostings@gmail.com",
        Subject: "Sending Email using javascript",
        Body: "Well that was easy!!",
      })
        .then(function (message) {
         var email_id=prompt("OTP has been sent to your mail Id. Enter the OTP:");
        });
    if(x==email_id)
    {   
        document.getElementById(y).submit();  
    }
    else if(email_id && email_id!=x && (email_id.includes("@")))
    {           
        alert("You don't have access to delete this item. Only the uploader can delete.");
    }
    else if(email_id)
    {
        alert("Please enter a valid email address!")
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





