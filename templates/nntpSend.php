 <?php include("style/top.php"); ?>


      

      <h3>NNTP Versandbericht</h3>
      <p>Folgende NNTP Post wurden verschickt:</p>
      <ul>
        <?php 
        foreach($send as $s)
        {
          echo "<li>".$s."</li>";
        }
        ?>
      </ul>
      <a href="<?php echo $next; ?>">Weiter</a>
    
 <?php include("style/bottom.php"); ?>