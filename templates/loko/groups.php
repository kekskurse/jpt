 <?php 
 // CONFIG
  $config["search"]=true;
  $config["aktiv"]=array("LoKo", "Groups");
  $config["actionMenu"]=array(array("name"=>"Hinzufügen", "href"=>"/loko/groups/new"));
  $config["breadcrumb"]=array(array("name"=>"Home"), array("name"=>"LoKo", "href"=>"/loko/contact"), array("name"=>"Gruppen", "href"=>"/loko/groups"));
  $config["menu"]="loko";
 //CONFIG ENDE
 include(__DIR__."/../style/top2.php"); 
 ?>


      

      <h3>Gruppen</h3>
      <p>Hier kannst du Gruppen verwalten. Diese Sind für die LoKo Einladungen und LoKo Ansprechpartner notwendig.</p>
      <table class="table table-striped" id="groups">
      </table>
      <script>
      $("#searchBox").keyup(function() {
          $("#groups tr").remove();
          $('#groups').append("<tr><th>Gruppen Name</th><th>Gruppen E-Mail</th><th>Bundesland</th><th>Tags</th><th>Weiteres</th><th>Aktionen</th></tr>");
          $.getJSON( "/loko/groups/search?q="+$("#searchBox").val(), function( data ) {
            $.each( data, function( key, val ) {
              var zeile = "<tr><td>"+val["name"]+"</td><td>"+val["mail"]+"</td><td>"+val["bundesland"]+"</td><td>";
              //val["aktiv"]
              if(val["aktiv"]==0){ zeile += '<span class="label label-danger">Inaktiv</span> '; }
              if(val["verwalter"]!="bund"){ zeile += '<span class="label label-info">Verwaltet duch '+val["verwalter"]+'</span>'; }
              zeile += "</td><td>"+val["more"]+"</td><td><a href='/loko/groups/edit?id="+val["id"]+"'><i class='fa fa-pencil'></i></a>&nbsp;<a href='/loko/groups/del?id="+val["id"]+"'><i class='fa fa-minus-circle'></i></a>&nbsp;<a href='/loko/contact?q=group:"+val["id"]+"'><i class='fa fa-eye'></i></a>&nbsp<a href='https://wiki.junge-piraten.de/wiki/"+val["wiki"]+"' target='_blank'>[WIKI]</a></td></tr>";
            $('#groups').append(zeile);
              //console.log(val);
            });
          });
      });
      $( "#searchBox" ).trigger( "keyup" );
      </script>
      
      

      


    
 <?php include(__DIR__."/../style/bottom2.php"); ?>