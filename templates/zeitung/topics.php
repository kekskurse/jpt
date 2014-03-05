 <?php 
  $config["search"]=true;
  $config["aktiv"]=array("Zeitung", "Topics");
  #$config["actionMenu"]=array(array("name"=>"Hinzufügen", "href"=>"/zeitung/contact"));
  $config["breadcrumb"]=array(array("name"=>"Home"), array("name"=>"LoKo", "href"=>"/loko/contact"), array("name"=>"Ansprechpartner", "href"=>"/loko/contact"));
  $config["menu"]="zeitung";
 include(__DIR__."/../style/top2.php"); ?>


      

      <h3>Topics</h3>
      <p>Hier ist eine übersicht der Topics</p>
      <ul class="list-group" style="width:250px;">
        <?php
        foreach($topics as $t)
        {
          echo "<li class='list-group-item'> <a href='/zeitung/contact?q=".$t."'0>".$t."</a></li>";
        }
        ?>
      </ul>
      
     
      

      


    
 <?php include(__DIR__."/../style/bottom2.php"); ?>