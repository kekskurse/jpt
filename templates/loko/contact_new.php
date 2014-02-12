 <?php include("../style/top.php"); ?>


      

      <h3>Ansprechpartner Bearbeiten</h3>
      <p>Neuen Ansprechpartner hinzufügen oder vorhanden Bearbeiten:</p>
      <form method="POST">
      	<input name="id" value="<?php echo $id; ?>" style="display:none;"><br>
      	<b>Name:</b><br>
      	<input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $name; ?>"><br>
      	<b>E-Mail:</b><br>
      	<input type="text" name="mail" class="form-control" placeholder="E-Mail Adresse" value="<?php echo $mail; ?>"><br>
            <b>Gruppe:</b><br>
            <select class="form-control" name="group">
                  <?php
                  foreach($groups as $g)
                  {
                        echo "<option value='".$g["id"]."'";
                        if($g["id"]==$group)
                        {
                              echo " selected";
                        }
                        echo ">".$g["name"]."</option>";
                  }
                  ?>
            </select>
      	<b>Weiteres:</b><br>
      	<textarea class="form-control" name="more" rows="10"><?php echo $more; ?></textarea><br>
	<input type="checkbox" name="lokoAnsprechpartner" <?php if($lokoAnsprechpartner){ echo "checked"; } ?>>Loko Ansprechpartner<br>
	<input type="checkbox" name="aktiv" <?php if($aktiv){ echo "checked"; } ?>>Aktiv<br>
      	<input type="submit" class="btn btn-default" value="Speichern">
      </form>
      
      

      


    
 <?php include("../style/bottom.php"); ?>
