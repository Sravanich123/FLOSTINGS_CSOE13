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
     <?php }
    }
   
   else{
      echo "No results";
   }
?>
