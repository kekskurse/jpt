 <?php include("../style/top.php"); ?>


      

      <h3>Listen Anlegen</h3>
      
      <form method="POST">
      	<b>Name:</b><br>
      	<input name="name" placeholder="Listenname" value="<?php echo $name; ?>" class="form-control"><br>
      	<input type="checkbox"name="aktiv">Aktiv<br>
      	<input type="submit" value="Hinzufügen" class="btn btn-default">
      </form>


      


    
 <?php include("../style/bottom.php"); ?>