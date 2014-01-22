 <?php include("../style/top.php"); ?>


      

      <h3>Gruppen</h3>
      <p>Hier kannst du <b>lokale</b> Gruppen verwalten. Diese Sind für die LoKo Einladungen und LoKo Ansprechpartner notwendig.</p>
      <a href="/loko/groups/new" class="btn btn-default">Hinzufügen</a><br><br>
      <table class="table table-striped" style="width:100%">
        <tr><th>Gruppen Name</th><th>Gruppen E-Mail</th><th>Weiteres</th><th>Aktionen</th></tr>
        <?php
        foreach($list as $entry)
        {
        	echo "<tr><td>";
        	if(!$entry["aktiv"])
        	{
        		echo "<i>";
        	}
        	echo $entry["name"];
        	if(!$entry["aktiv"])
        	{
        		echo "<br>(INAKTIV)</i>";
        	}
        	echo "</td><td>".$entry["mail"]."</td><td>".nl2br($entry["more"])."</td><td><a href='/loko/groups/edit?id=".$entry["id"]."'>[EDIT]</a><a href='/loko/groups/del?id=".$entry["id"]."'>[DEL]</a><a href='https://wiki.junge-piraten.de/wiki/".$entry["wiki"]."' target='_blank'>[WIKI]</td></tr>";
        }
        ?>
      </table>
      
      

      


    
 <?php include("../style/bottom.php"); ?>