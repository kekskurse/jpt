 <?php 
 // CONFIG
  $config["search"]=true;
  $config["aktiv"]=array("LoKo", "Ansprechpartner");
  $config["actionMenu"]=array(array("name"=>"Hinzufügen", "href"=>"/loko/contact/new"));
  $config["breadcrumb"]=array(array("name"=>"Home"), array("name"=>"LoKo", "href"=>"/loko/contact"), array("name"=>"Ansprechpartner", "href"=>"/loko/contact"));
$config["menu"]="loko";
 //CONFIG ENDE
 include(__DIR__."/../style/top2.php"); 
 ?>


      

      <h3>Ansprechpartner</h3>
      <p>Hier kannst du die Kontaktdaten für die <b>Lokalen</b> Crews verwalten. Diese werden auch für die Persöhnlichen Einladungen genutzt.</p>
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
      $("#searchBox").keyup(function() {
          $("#groups tr").remove();
          $('#groups').append("<tr><th>Name</th><th>Gruppe</th><th>E-Mail Adresse</th><th>Weiteres</th><th>Tags</th><th>Aktionen</th></tr>");
          $.getJSON( "/loko/contact/search?q="+$("#searchBox").val(), function( data ) {
            $.each( data, function( key, val ) {
              //$('#groups').append("<tr><td>"+val["name"]+"</td><td>"+val["mail"]+"</td><td>"+val["bundesland"]+"</td><td>"+val["aktiv"]+"</td><td>"+val["more"]+"</td><td><a href='/loko/groups/edit?id="+val["id"]+"'><i class='fa fa-pencil'></i></a>&nbsp;<a href='/loko/groups/del?id="+val["id"]+"'><i class='fa fa-minus-circle'></i></a>&nbsp;<a href='/loko/groups/detais?id="+val["id"]+"'><i class='fa fa-eye'></i></a>&nbsp<a href='https://wiki.junge-piraten.de/wiki/"+val["wiki"]+"' target='_blank'>[WIKI]</a></td></tr>");
              var zeile = "<tr><td>"+val["name"]+"</td><td>"+val["groupName"]+"</td><td>"+val["mail"]+"</td><td>"+val["more"]+"</td><td>";
	//<span class="label label-info">Info</span>
		if(val["aktiv"]==0){  zeile += '<span class="label label-danger">Inaktiv</span> '; }
		if(val["lokoAnsprechpartner"]==1){ zeile += '<span class="label label-info">LoKo Ansprechpartner</span> ' }
		if(val["nntpName"]!=null){  zeile += '<span class="label label-success">NNTP Account</span> '; }
    if(val["verwalter"]!="bund"){ zeile += '<span class="label label-info">Verwaltet duch '+val["verwalter"]+'</span>'; }
	      zeile += "</td><td><a href='/loko/contact/edit?id="+val["id"]+"'><i class='fa fa-pencil'></i></a>&nbsp;<a href='/loko/contact/del?id="+val["id"]+"'><i class='fa fa-minus-circle'></i></a></td></tr>";
		$('#groups').append(zeile);
              console.log(val);
            });
          });
      });
      $( "#searchBox" ).trigger( "keyup" );
      </script>
      

      


    
 <?php 
 include(__DIR__."/../style/bottom2.php"); 
 ?>
