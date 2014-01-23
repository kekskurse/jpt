 <?php include("../style/top.php"); ?>


      

      <h3>Listen</h3>
      <div style="float:right;width:300px;">
        <input class="form-control" id="q" placeholder="Suche" value=""><!--<input type="submit" id="suchen" value="Suchen" class="btn btn-default" style="float:right">!-->
      </div>
      <p>Hier eine übersicht der aktiven Listen</p>
      <a href="/lists/new" class="btn btn-default">Hinzufügen</a><br><br>
      <table style="width:100%" id="groups" class="table table-striped">
      </table>
    <script>
      $("#q").keyup(function() {
          $("#groups tr").remove();
          $('#groups').append("<tr><th>ListName</th><th>Aktiv</th><th>Aktionen</th></tr>");
          $.getJSON( "/lists/search?q="+$("#q").val(), function( data ) {
            $.each( data, function( key, val ) {
              $('#groups').append("<tr><td>"+val["name"]+"</td><td>"+val["aktiv"]+"</td><td><a href='/lists/list?id="+val["id"]+"'>[Einträge]</a> <a href='/lists/structur?id="+val["id"]+"'>[Stuktur]</a> [Edit] [API]</td></tr>");
              //console.log(val);
            });
          });
      });
      $( "#q" ).trigger( "keyup" );
      </script>

      


    
 <?php include("../style/bottom.php"); ?>