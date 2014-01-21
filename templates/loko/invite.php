 <?php include("../style/top.php"); ?>


      

      <h3>LoKo Mumble</h3>
      <p>Die Einladung wird in alle Regionalforen und das Ankündigungen geschrieben.</p>
      <?php
      $monate = array(1=>"Januar",
                2=>"Februar",
                3=>"M&auml;rz",
                4=>"April",
                5=>"Mai",
                6=>"Juni",
                7=>"Juli",
                8=>"August",
                9=>"September",
                10=>"Oktober",
                11=>"November",
                12=>"Dezember");
      echo "<div class='alert alert-warning'>Die Einladung ist für den Monat ".$monate[date("m")+1]."! Bei anderen Monaten passe den Text bitte an.</div>"
      ?>
      <form method="post">
        <input type="text" class="form-control" name="subject" value="Einladung zum LoKo Mumble am 03.<?php if(date("m")+1<10){echo"0";}?><?php echo date("m")+1; ?>.<?php echo date("Y"); ?> um 21:00 Uhr"><br>
        <textarea class="form-control" rows="20" name="text">
Ohai,

am 03.<?php if(date("m")+1<10){echo"0";}?><?php echo date("m")+1; ?>.<?php echo date("Y"); ?> um 21:00 findet das nächste Lokalkoordinations-Mumble statt. Auf diesem möchten wir den Austausch der unterschiedlichen lokalen Gruppen fördern. Auf dem Treffen sollen alle Gruppen ihre aktuellen Planungen für Aktionen u.ä. ausgiebig vorstellen. Hierdurch könnt ihr durch Erfahrungen anderer Gruppen und umgekehrt andere von euren Erfahrungen profitieren.

Außerdem könnt ihr die Veranstaltung nutzen um Fragen zur Organisation oder an den Bundesvorstand zu stellen. Wir bitten darum, dass aus jeder Gruppe mindestens ein Vertreter zu dem Treffen erscheint. Die Tagesordnung findet ihr in folgendem Pad:

http://pad.junge-piraten.de/loko-<?php echo date("Y"); ?>-<?php if(date("m")+1<10){echo"0";}?><?php echo date("m")+1; ?>-03

Viele Grüße,
LoKoDerps
</textarea><br>
<input type="checkbox" class="form-controll" name="test" checked="checked">Test Einladung (Wird nur im Test Forum gepostet)<br>
        <input type="submit" class="btn btn-default">
      </form>
      

      


    
 <?php include("../style/bottom.php"); ?>