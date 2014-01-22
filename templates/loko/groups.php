 <?php include("../style/top.php"); ?>


      

      <h3>Gruppen</h3>
      <div style="float:right;width:300px;">
        <input class="form-control" id="q" placeholder="Suche"><!--<input type="submit" id="suchen" value="Suchen" class="btn btn-default" style="float:right">!-->
      </div>
      <p>Hier kannst du <b>lokale</b> Gruppen verwalten. Diese Sind für die LoKo Einladungen und LoKo Ansprechpartner notwendig.</p>
      <a href="/loko/groups/new" class="btn btn-default">Hinzufügen</a><br><br>
      <table class="table table-striped" style="width:100%" id="groups">
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
      <script>
      $("#q").keyup(function() {
          $("#groups tr").remove();
          $('#groups').append("<tr><th>Gruppen Name</th><th>Gruppen E-Mail</th><th>Weiteres</th><th>Aktionen</th></tr>");
          $.getJSON( "http://jpt/loko/groups/search?q="+$("#q").val(), function( data ) {
            $.each( data, function( key, val ) {
              $('#groups').append("<tr><td>"+val["name"]+"</td><td>"+val["mail"]+"</td><td>"+val["more"]+"</td><td><a href='/loko/groups/edit?id="+val["id"]+"'>[EDIT]</a><a href='/loko/groups/del?id="+val["id"]+"'>[DEL]</a><a href='https://wiki.junge-piraten.de/wiki/"+val["wiki"]+"' target='_blank'>[WIKI]</a></td></tr>");
              console.log(val);
            });
          });
      });
      </script>
      
      

      


    
 <?php include("../style/bottom.php"); ?>