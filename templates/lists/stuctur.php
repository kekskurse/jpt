 <?php include("../style/top.php"); ?>


      

      <h3>Structur</h3>
      
      <p>Bearbeite die Sturktur der Liste</p>
     
      <table style="width:100%" id="groups" class="table table-striped">
        <tr><th>Name</th><th>Typ</th><th>Aktionen</th></tr>
        <?php
        #$structur
        foreach($structur as $feld)
        {
          echo "<tr><td>".$feld["name"]."</td><td>".$feld["typ"]."</td><td></td></tr>";
        }
        ?>
      </table>
      <hr>
      <form method="POST">
        <b>Bezeichnung:</b><br>
        <input type="text" class="form-control"  name="name" placeholder="Bezeichnung"><br>
        <b>Typ:</b><br>
        <select name="typ" class="form-control">
          <option value="int">Ganzzahl</option>
          <option value="string" selected>Zeichenkette</option>
          <option value="text">Text</option>
        </select>
        <br>
        <input type="submit" class="btn btn-default" value="Hinzufügen">
      </form>
   

      


    
 <?php include("../style/bottom.php"); ?>