 <?php include(__DIR__."/../style/top.php"); ?>


      

      <h3>Workflow Group</h3>
      <p>Neuen Worklfowgroups hinzufügen oder vorhanden Bearbeiten:</p>
      <form method="POST">
      	<input name="id" value="<?php echo $id; ?>" style="display:none;"><br>
      	<b>Name:</b><br>
      	<input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $name; ?>"><br>
	<input type="checkbox" name="aktiv" <?php if($aktiv){ echo "checked"; } ?>>Aktiv<br>
      	<input type="submit" class="btn btn-default" value="Speichern">
      </form>
      
      

      


    
 <?php include(__DIR__."/../style/bottom.php"); ?>
