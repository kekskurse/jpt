 <?php include(__DIR__."/../style/top.php"); ?>


      

      <h3>Workflow Groups</h3>
      <p>Hier kannst du Gruppen zu denen Workflows definiert werden können verwalten.</p>
      <a href="/workflow/groups/new" class="btn btn-default">Hinzufügen</a><br><br>
      <table class="table table-striped" style="width:100%">
        <tr><th>Name</th><th>Tags</th><th>Aktionen</th></tr>
       <?php
       foreach($list as $entry)
       {
          echo "<tr><td>".$entry["name"]."</td><td>";
          if($entry["aktiv"]==0){ echo '<span class="label label-danger">Inaktiv</span>'; }
          echo "</td><td><a href='/workflow/groups/edit?id=".$entry["id"]."'>[Edit]</a> <a href='/workflow/groups/rm?id=".$entry["id"]."'>[DEL]</a></td></tr>";
       }
       ?>
      </table>
      
      


    
 <?php include(__DIR__."/../style/bottom.php"); ?>