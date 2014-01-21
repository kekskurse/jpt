 <?php include("../style/top.php"); ?>


      

      <h3>Ansprechpartner</h3>
      <p>Hier kannst du die Kontaktdaten für die <b>Lokalen</b> Crews verwalten. Diese werden auch für die Persöhnlichen Einladungen genutzt.</p>
      <a href="/loko/contact/new" class="btn btn-default">Hinzufügen</a><br><br>
      <table class="table table-striped" style="width:100%">
        <tr><th>Name</th><th>Gruppe</th><th>E-Mail Adresse</th><th>Weiteres</th><th>Aktionen</th></tr>
        <?php
        foreach($list as $e)
        {
          echo "<tr><td>".$e["name"]."</td><td>".$e["groupName"]."</td><td>".$e["mail"]."</td><td>".nl2br($e["more"])."</td><td><a href='/loko/contact/edit?id=".$e["id"]."'>[EDIT]</a><a href='/loko/contact/del?id=".$e["id"]."'>[DEL]</a></td></tr>";
        }
        ?>
        
      </table>
      
      

      


    
 <?php include("../style/bottom.php"); ?>