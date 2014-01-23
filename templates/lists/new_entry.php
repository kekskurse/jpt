 <?php include("../style/top.php"); ?>


      

      <h3>Neuer Datensatz</h3>
      Hier kannst du einen Datensatz hinzufügen oder bearbeiten.
      <hr>
      <form method="POST">
        <?php
        foreach($struktur as $feld)
        {
          if($feld["typ"]=="string")
          {
            echo "<b>".$feld["name"]."</b><br><input name='".$feld["name"]."' class='form-control'><br>";
          }
          elseif($feld["typ"]=="int")
          {
            echo "<b>".$feld["name"]."</b><br><input type='number' name='".$feld["name"]."' class='form-control'><br>";
          }
          elseif($feld["typ"]=="text")
          {
            echo "<b>".$feld["name"]."</b><br><textarea class='form-control' name='".$feld["name"]."' rows='5'></textarea><br>";
          }
          else
          {
            echo "<b>TYP ".$feld["typ"]." NOT DEFINED</b><br>";
          }
        }
        ?>
        <input type="submit" value="Hinzufügen" class="btn btn-default">
      </form>
      <hr>

      


    
 <?php include("../style/bottom.php"); ?>