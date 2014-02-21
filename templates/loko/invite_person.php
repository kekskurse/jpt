 <?php 
 // CONFIG
  $config["search"]=false;
  $config["aktiv"]=array("LoKo", "InvitePerson");
  #$config["actionMenu"]=array(array("name"=>"Hinzufügen", "href"=>"/loko/contact/new"));
    $config["breadcrumb"]=array(array("name"=>"Home"), array("name"=>"LoKo", "href"=>"/loko/contact"), array("name"=>"Persöhnliche Einladung", "href"=>"/loko/invite/person"));
$config["menu"]="loko";
 //CONFIG ENDE
 include(__DIR__."/../style/top2.php"); 
 ?>



      
      <h3>LoKo Mumble Ansprechpartner*innen</h3>
      <p>Die Einladung wird an alle Ansprechpartner*innen geschickt.</p>
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
Hallo %name%,

am 03.<?php if(date("m")+1<10){echo"0";}?><?php echo date("m")+1; ?>.<?php echo date("Y"); ?> um 21:00 Uhr findet das nächste LoKo Mumble statt. Du 
bist als Ansprechpartner*in für die Gruppe %group% bei uns hinterlegt. Damit hast Du auch die Aufgabe, in Deiner Gruppe eine verantwortliche Person für die 
Lokalkoordinations-Mumbles zu finden, die an den Mumbletreffen teilnimmt.  ichtig ist, dass aus Deiner Gruppe mindestens ein*e Vertreter*in an dem Treffen 
teilnimmt.

Wenn Ihr an dem Termin verhindert seid, schreibt doch bitte kurz in das Protokoll-Pad unter http://pad.junge-piraten.de/loko-<?php echo date("Y"); ?>-<?php 
if(date("m")+1<10){echo"0";}?><?php echo date("m")+1; ?>-03 was Ihr gemacht habt. Bitte achtet darauf, dass die Angaben auch für Außenstehende verständlich sind 
;)

Falls Du Fragen zu dem Treffen hast, kannst Du diese gerne per E-Mail an loko@junge-piraten.de stellen.

Viele Grüße
LoKo-Derps
</textarea><br>
<input type="checkbox" class="form-controll" name="test" checked="checked">Test Einladung (Wird nur an mich geschickt)<br>
        <input type="submit" class="btn btn-default">
      </form>
      

      


    
 <?php include(__DIR__."/../style/bottom2.php"); ?>
