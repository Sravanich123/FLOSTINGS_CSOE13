<?php
 include 'db.php';

 $query = "SELECT * FROM Images WHERE LOWER(Item_Name) LIKE LOWER('%".$_POST['name']."%')";
 $result = pg_query($con, $query); 
    if (pg_num_rows($result)>0)
    {
      while ($row = pg_fetch_row($result)) 
      { ?>
            <section class="record">
            <!-- <div class="record-arrow">
                <i style="color: rgb(21, 170, 46);" class="fa-solid fa-check"></i>
            </div> -->
            <div id="record1" class="record-display" >
                <img src="<?php echo $row[4];?>" style="width:230px;height:290px;object-fit:fill;" alt="image"/>
                <a href="#">CONTACT</a>
            </div>
            <div class="record-desc">
                <h1>DETAILS</h1>
                <p><b>Item: </b><?php echo $row[1];?><br>
                <b>Found at: &nbsp;</b> <?php echo $row[2];?><br>
                <b>Found on: </b><?php echo $row[3];?><br>
                <b>Mob no: &nbsp;&nbsp;&nbsp;</b><?php echo $row[6];?><br>
                </p>
                <!-- <button class="contact-button">
                <a href="#">CONTACT</a>
                </button> -->
            </div>
        </section>
     <?php }
    }
   
   else{
      echo "No results";
   }
?>
