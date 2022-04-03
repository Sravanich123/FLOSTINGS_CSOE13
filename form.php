
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
        <li><a href="index.php"><i class="fa-solid fa-house"></i> Home</a></li>
        <li><a href="index1.php" style="text-decoration: none;">Items page <i class="fa-solid fa-angle-right"></i></a></li>
    </ul>
    <div id="thank-you-message"><p>Thank you for publishing the item. Redirecting you to items page in few seconds.....</p></div>
    <h1>Fill the Details of Found Item</h1>
    <form action="form1.php" method="post" enctype="multipart/form-data">
        <div class="form_flex"><div class="div"><div class="item"><a>Item Name : </a><input type="text" name="item_name" required></div>
        <div class="item"><a>Found At : </a><input type="text" placeholder="Location" name="location" required></div>
       <div class="item"><a>Found On : </a><input type="date" name="date" id="datePicker" placeholder="Date" required></div></div>
       <div class="div"><div class="item"><a>Upload Image : </a><input type="file" accept="Image/*" name="fileToUpload" required></div>
       
       <div class="item"><a>Email Address : </a><input type="email" name="email" required></div>
        <div class="item"><a>Phone Number : </a><input type="tel" name="phone_no" required></div></div></div>
        <div class="button"><button type ="submit">Publish</button></div>
    </form>
    <script>
        document.getElementById('datePicker').value = new Date().toISOString().substring(0, 10);
        document.getElementById('datePicker').max = new Date().toISOString().substring(0, 10);
        const form = document.querySelector('form');
        const thankYouMessage = document.querySelector('#thank-you-message');
        form.addEventListener('submit', (e) => {
        e.preventDefault();
        thankYouMessage.classList.add('show');
        setTimeout(() => form.submit(), 1200);
    });
    </script>
</body>
</html>
