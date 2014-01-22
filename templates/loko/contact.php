 <?php include("../style/top.php"); ?>


      

      <h3>Ansprechpartner</h3>
      <div style="float:right;width:300px;">
        <input class="form-control" id="q" placeholder="Suche" value="<?php echo $q; ?>"><!--<input type="submit" id="suchen" value="Suchen" class="btn btn-default" style="float:right">!-->
      </div>
      <p>Hier kannst du die Kontaktdaten für die <b>Lokalen</b> Crews verwalten. Diese werden auch für die Persöhnlichen Einladungen genutzt.</p>
      <a href="/loko/contact/new" class="btn btn-default">Hinzufügen</a><br><br>
      <table id="groups" class="table table-striped" style="width:100%">
        <tr><th>Name</th><th>Gruppe</th><th>E-Mail Adresse</th><th>Weiteres</th><th>Aktionen</th></tr>
        <?php
        /*foreach($list as $e)
        {
          echo "<tr><td>".$e["name"]."</td><td>".$e["groupName"]."</td><td>".$e["mail"]."</td><td>".nl2br($e["more"])."</td><td><a href='/loko/contact/edit?id=".$e["id"]."'><i class='fa fa-pencil'></i></a>&nbsp;<a href='/loko/contact/del?id=".$e["id"]."'><i class='fa fa-minus-circle'></i></a></td></tr>";
        }*/
        ?>
        
      </table>
      <script>
      $("#q").keyup(function() {
          $("#groups tr").remove();
          $('#groups').append("<tr><th>Name</th><th>Gruppe</th><th>E-Mail Adresse</th><th>Weiteres</th><th>Aktionen</th></tr>");
          $.getJSON( "/loko/contact/search?q="+$("#q").val(), function( data ) {
            $.each( data, function( key, val ) {
              //$('#groups').append("<tr><td>"+val["name"]+"</td><td>"+val["mail"]+"</td><td>"+val["bundesland"]+"</td><td>"+val["aktiv"]+"</td><td>"+val["more"]+"</td><td><a href='/loko/groups/edit?id="+val["id"]+"'><i class='fa fa-pencil'></i></a>&nbsp;<a href='/loko/groups/del?id="+val["id"]+"'><i class='fa fa-minus-circle'></i></a>&nbsp;<a href='/loko/groups/detais?id="+val["id"]+"'><i class='fa fa-eye'></i></a>&nbsp<a href='https://wiki.junge-piraten.de/wiki/"+val["wiki"]+"' target='_blank'>[WIKI]</a></td></tr>");
              $('#groups').append("<tr><td>"+val["name"]+"</td><td>"+val["groupName"]+"</td><td>"+val["mail"]+"</td><td>"+val["more"]+"</td><td><a href='/loko/contact/edit?id="+val["id"]+"'><i class='fa fa-pencil'></i></a>&nbsp;<a href='/loko/contact/del?id="+val["id"]+"'><i class='fa fa-minus-circle'></i></a></td></tr>");
              console.log(val);
            });
          });
      });
      $( "#q" ).trigger( "keyup" );
      </script>
      

      


    
 <?php include("../style/bottom.php"); ?>