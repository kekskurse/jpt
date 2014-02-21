 <?php 
 // CONFIG
  $config["search"]=true;
  $config["aktiv"]=array("LoKo", "Groups");
  #$config["actionMenu"]=array(array("name"=>"Hinzufügen", "href"=>"/loko/groups/new"));
  $config["breadcrumb"]=array(array("name"=>"Home"), array("name"=>"LoKo", "href"=>"/loko/contact"), array("name"=>"Gruppen", "href"=>"/loko/groups"), array("name"=>"Hinzufügen", "href"=>"/loko/groups/new"));

 //CONFIG ENDE
 include(__DIR__."/../style/top2.php"); 
 ?>



      

      <h3>Gruppe Bearbeiten</h3>
      <p>Neue Gruppe Anlegen oder vorhandene Gruppe bearbeiten:</p>
      <form method="POST">
      	<input name="id" value="<?php echo $id; ?>" style="display:none;"><br>
            <b>Typen</b><br>
            <select class="form-control" name="typ">
                  <?php
                  foreach($typen as $t)
                  {     
                        echo "<option";
                        if($t==$typ)
                        {
                              echo " selected='selected'";
                        }
                        echo ">".$t."</option>";
                  }
                  ?>
            </select><br>
      	<b>Name:</b><br>
      	<input type="text" name="name" class="form-control" placeholder="Gruppen Name" value="<?php echo $name; ?>"><br>
      	<b>E-Mail:</b><br>
      	<input type="text" name="mail" class="form-control" placeholder="E-Mail Adresse" value="<?php echo $mail; ?>"><br>
            <b>Bundesland</b><br>
            <select class="form-control" name="bundesland">
                  <?php
                  foreach($listelaender as $laend)
                  {     
                        echo "<option";
                        if($laend==$bundesland)
                        {
                              echo " selected='selected'";
                        }
                        echo ">".$laend."</option>";
                  }
                  ?>
            </select><br>
            <b>Wiki:</b><br>
            <input type="text" name="wiki" class="form-control" placeholder="Wiki (z.B. 'BE:Hauptseite')" value="<?php echo $wiki; ?>"><br>
      	<b>Weiteres:</b><br>
      	<textarea class="form-control" name="more" rows="10"><?php echo $more; ?></textarea><br>
      	<input type="checkbox" name="aktiv" <?php if($aktiv) { echo "checked"; } ?>>  Aktiv<br><br>
      	<input type="submit" class="btn btn-default" value="Speichern">
      </form>
      
      

      


    
 <?php include(__DIR__."/../style/bottom2.php"); ?>