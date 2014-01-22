 <?php include("../style/top.php"); ?>


      

      <h3>Gruppen</h3>
      <div style="float:right;width:300px;">
        <input class="form-control" id="q" placeholder="Suche"><!--<input type="submit" id="suchen" value="Suchen" class="btn btn-default" style="float:right">!-->
      </div>
      <p>Hier kannst du <b>lokale</b> Gruppen verwalten. Diese Sind für die LoKo Einladungen und LoKo Ansprechpartner notwendig.</p>
      <a href="/loko/groups/new" class="btn btn-default">Hinzufügen</a><br><br>
      <table class="table table-striped" style="width:100%" id="groups">
      </table>
      <script>
      $("#q").keyup(function() {
          $("#groups tr").remove();
          $('#groups').append("<tr><th>Gruppen Name</th><th>Gruppen E-Mail</th><th>Bundesland</th><th>Aktiv</th><th>Weiteres</th><th>Aktionen</th></tr>");
          $.getJSON( "/loko/groups/search?q="+$("#q").val(), function( data ) {
            $.each( data, function( key, val ) {
              $('#groups').append("<tr><td>"+val["name"]+"</td><td>"+val["mail"]+"</td><td>"+val["bundesland"]+"</td><td>"+val["aktiv"]+"</td><td>"+val["more"]+"</td><td><a href='/loko/groups/edit?id="+val["id"]+"'><i class='fa fa-pencil'></i></a>&nbsp;<a href='/loko/groups/del?id="+val["id"]+"'><i class='fa fa-minus-circle'></i></a>&nbsp;<a href='/loko/groups/detais?id="+val["id"]+"'><i class='fa fa-eye'></i></a>&nbsp<a href='https://wiki.junge-piraten.de/wiki/"+val["wiki"]+"' target='_blank'>[WIKI]</a></td></tr>");
              //console.log(val);
            });
          });
      });
      $( "#q" ).trigger( "keyup" );
      </script>
      
      

      


    
 <?php include("../style/bottom.php"); ?>