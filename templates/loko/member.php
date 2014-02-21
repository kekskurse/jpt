 <?php 
 // CONFIG
  $config["search"]=false;
  $config["aktiv"]=array("LoKo", "Member");
  #$config["actionMenu"]=array(array("name"=>"Hinzufügen", "href"=>"/loko/contact/new"));
    $config["breadcrumb"]=array(array("name"=>"Home"), array("name"=>"LoKo", "href"=>"/loko/contact"), array("name"=>"LoKo Menschen", "href"=>"/loko/member"));
    $config["menu"]="loko";
 //CONFIG ENDE
 include(__DIR__."/../style/top2.php"); 
 ?>



      

      <h3>LoKo Menschen</h3>
      <p>Hier kannst du die LoKo Beauftrageten Eintragen, diesen werden jeden 25. darüber Informiert das es bald wieder ein LoKo Mumble gibt.</p>
      <table class="table table-striped" style="width:100%">
        <tr><th>Twitter Name</th><th>Aktionen</th></tr>
        <?php
          foreach($lokoMenschen as $mensch)
          {
            echo "<tr><td><a href='http://www.twitter.com/".$mensch["name"]."' target='_blank'>@".$mensch["name"]."</a></td><td><a href='/loko/member?del=".$mensch["name"]."'><i class='fa fa-minus-circle'></i></A></td></tr>";
          }
        ?>
      </table>
      <hr>
      <h4>Hinzufügen</h4>
      <form method="POST">
        <input type="text" class="form-control" name="twitter" placeholder="@TwitterName"><br>
        <input type="submit" class="btn btn-default">
      </form>
      

      


    
 <?php include(__DIR__."/../style/bottom2.php"); ?>