 <?php include("../style/top.php"); ?>


      

      <h3>Topics</h3>
      <p>Hier ist eine übersicht der Topics</p>
      <ul>
        <?php
        foreach($topics as $t)
        {
          echo "<li> <a href='/zeitung/contact?q=".$t."'0>".$t."</a></li>";
        }
        ?>
      </ul>
      
     
      

      


    
 <?php include("../style/bottom.php"); ?>