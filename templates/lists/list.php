 <?php include("../style/top.php"); ?>


      

      <h3>Liste</h3>
      <div style="float:right;width:300px;">
        <input class="form-control" id="q" placeholder="Suche" value=""><!--<input type="submit" id="suchen" value="Suchen" class="btn btn-default" style="float:right">!-->
      </div>
      <p>Hier der Listeninhalt</p>
      <a href="/lists/list/new?id=<?php echo $id; ?>" class="btn btn-default">Datensatz Hinzufügen</a><br><br>
      <table style="width:100%" id="groups" class="table table-striped">
      </table>
    <script>
      $("#q").keyup(function() {
          $("#groups tr").remove();
           $.getJSON("/lists/list/structur?id=<?php echo $id; ?>", function (data) {
            var head = "<tr>";
            $.each( data, function( key, val ) {
              console.log(val);
              head = head + "<th>"+val["name"]+"</th>";
            });
            head = head + "<th>Aktionen</th>";
            head = head + "</tr>";
            $('#groups').append(head);
            $.getJSON( "/lists/list/entries?id=<?php echo $id; ?>&q="+$("#q").val(), function( data ) {
            $.each( data, function( key, val ) {
              var line = "<tr>";
                $.each(val, function (k, v) {
                  line = line + "<td>"+v+"</td>";
                });
              line = line + "<td></td></tr>";
              $('#groups').append(line);
            });
          });
          });
          //"<tr><th>ListName</th><th>Aktiv</th><th>Aktionen</th></tr>");
          
      });
      $( "#q" ).trigger( "keyup" );
      </script>

      


    
 <?php include("../style/bottom.php"); ?>