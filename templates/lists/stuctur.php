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
      <form method="POST" id="structurform">
        <b>Bezeichnung:</b> <span id="nameError" style="color:red;display:none;">Nur Buchestaben a-z und A-Z</span><br>
        <input type="text" id="nameInput" class="form-control"  name="name" placeholder="Bezeichnung"><br>
        <b>Typ:</b><br>
        <select name="typ" class="form-control">
          <option value="int">Ganzzahl</option>
          <option value="string" selected>Zeichenkette</option>
          <option value="text">Text</option>
        </select>
        <br>
        <input type="submit" class="btn btn-default" value="Hinzufügen">
      </form>
      <script>
      $('#nameInput').keyup(function() {
        $('#nameError').hide();
        var inputVal = $(this).val();
        var numericReg = /^[a-zA-Z]*$/;
        if(!numericReg.test(inputVal)) {
            $('#nameError').show();
        }
    });
      $( "#structurform" ).submit(function() {
        var inputVal = $("#nameInput").val();
        var numericReg = /^[a-zA-Z]*$/;
        if(!numericReg.test(inputVal)) {
          alert("Nur Buchestaben a-z und A-Z");
            return false;
        }
        return true;
      });
      </script>
   

      


    
 <?php include("../style/bottom.php"); ?>