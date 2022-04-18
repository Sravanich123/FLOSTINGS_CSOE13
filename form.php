<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Found Item Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="form.css">
    <link rel="shortcut icon" href="src/f.png">
    <script src="https://kit.fontawesome.com/57630a8715.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <?php

    include 'db.php';
    require 'vendor/autoload.php';
    require 'config.php';?>
    <ul>
        <li><a class="nav-items"  href="index.php"><i class="fa-solid fa-house">&nbsp;</i>Home</a></li>
        <li><a class="nav-items" href="index1.php">View Items<i class="fa-solid fa-angle-right icon"></i></a></li>
   </ul>
    <div id="thank-you-message"><p>OTP has been verified. Thank you for publishing the item. Redirecting you to items page in few seconds.....</p></div>
    <h1>Fill the Details of Found Item</h1>
    <form action="form1.php" method="post" enctype="multipart/form-data">
        <div class="form_flex">
            <div class="div">
                <div class="item">
                    <span>Item Name : </span>
                    <input class="input1" type="text" name="item_name" required>
                </div>
                <div class="item">
                    <span>Found At : </span>
                    <input class="input1" type="text" placeholder="Location" name="location" required>
                </div>
                <div class="item">
                    <span>Found On : </span>
                    <input class="input1" type="date" name="date" id="datePicker" placeholder="Date" required>
                </div>
            </div>
            <div class="div">
                <div class="item">
                    <span>Upload Image : </span>
                     <input class="input1" type="file" name="file" accept="image/*" required>
                </div>
                <div class="item">
                    <span>Email Address : </span>
                    <input class="input1" type="email" id="mail" name="email" required>
                </div>
                <div class="item">
                    <span>Phone Number : </span>
                    <input class="input1" type="tel" name="phone_no" required>
                </div>
            </div>
        </div>
        <div class="button"><button class="btn"  type ="submit">Publish</button></div>
    </form>
    <div id="bg" style="position: fixed;"></div>
    <div id="otppopup" style="position: fixed;">
        <div id="headings" style="display:flex;">
            <a style="font-size: 17.5px;float:left; color:rgb(57,43,87);" id="otp">OTP has been sent to the your email address.(Please check in your spam also)</a>
            <i style="float:right;" onclick="closeform()" class="close">&times</i>
        </div>
        <br>  
        <input id="otp1" name="otp1" type="number" placeholder="Enter the OTP">
        <small id="incorrectotp" style="color:red;"></small>
        <button id="otpverify" onclick="otpverify()">Verify</button>
    </div>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script type="text/javascript">
        document.getElementById('datePicker').value = new Date().toISOString().substring(0, 10);
        document.getElementById('datePicker').max = new Date().toISOString().substring(0, 10);
        const form = document.querySelector('form');
        const thankYouMessage = document.querySelector('#thank-you-message');
        form.addEventListener('submit', (e) => {
        e.preventDefault();
        var x=document.getElementById('mail').value;
	    otp=Math.floor((Math.random() * 8999) + 1000);
        Email.send({
	    SecureToken : "e4064595-4dbb-4d05-ad99-9c3a58e63396",
        To: x,
        From: "flostings@gmail.com",
        Subject: "OTP From Flostings to Publish the Item.",
        Body: "Dear User, your OTP is : "+ otp,
        });
            document.getElementById('otppopup').style.visibility='visible';
            document.getElementById('bg').style.visibility='visible';
        
         });
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
                document.getElementById('incorrectotp').style.color='green';
                document.getElementById('incorrectotp').innerHTML='OTP has been verified. Thank you for publishing the item. Redirecting you to items page in few seconds.....' +'<br><br>';
                //document.getElementById('otppopup').style.visibility='hidden';
                //document.getElementById('bg').style.visibility='hidden';
                //document.getElementById('incorrectotp').innerHTML='';
                //thankYouMessage.classList.add('show');
                //window.location.href='#thank-you-message'
                form.submit();  
            }  
        }  
    </script>
</body>
</html>
