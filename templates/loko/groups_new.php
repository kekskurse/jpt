 <?php include("../style/top.php"); ?>


      

      <h3>Gruppe Bearbeiten</h3>
      <p>Neue Gruppe Anlegen oder vorhandene Gruppe bearbeiten:</p>
      <form method="POST">
      	<input name="id" value="<?php echo $id; ?>" style="display:none;"><br>
      	<b>Name:</b><br>
      	<input type="text" name="name" class="form-control" placeholder="Gruppen Name" value="<?php echo $name; ?>"><br>
      	<b>E-Mail:</b><br>
      	<input type="text" name="mail" class="form-control" placeholder="E-Mail Adresse" value="<?php echo $mail; ?>"><br>
      	<b>Weiteres:</b><br>
      	<textarea class="form-control" name="more" rows="10"><?php echo $more; ?></textarea><br>
      	<input type="checkbox" name="aktiv" <?php if($aktiv) { echo "checked"; } ?>>  Aktiv<br><br>
      	<input type="submit" class="btn btn-default" value="Speichern">
      </form>
      
      

      


    
 <?php include("../style/bottom.php"); ?>