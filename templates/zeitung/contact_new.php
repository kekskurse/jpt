 <?php 
 // CONFIG
  $config["search"]=false;
  $config["aktiv"]=array("Zeitung", "Ansprechpartner");
  #$config["actionMenu"]=array(array("name"=>"Hinzufügen", "href"=>"/zeitung/contact"));
  $config["breadcrumb"]=array(array("name"=>"Home"), array("name"=>"Zeitung", "href"=>"/zeitung/contact"), array("name"=>"Ansprechpartner", "href"=>"/zeitung/contact"), array("name"=>"Hinzufügen", "href"=>"/zeitung/contact/new"));
  $config["menu"]="zeitung";

 //CONFIG ENDE
 include(__DIR__."/../style/top2.php");  ?>
<script src="/js/jquery.tagsinput.js"></script>
<script>
jQuery.curCSS = jQuery.css;
</script>
<link href="/css/jquery.tagsinput.css" rel="stylesheet" type="text/css">
<script type='text/javascript' src='/js/jquery-ui.min.
js'></script>
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css" />
<style type="text/css">
.ui-autocomplete
{
      margin-top:500px;
}
</style>

      

      <h3>Ansprechpartner Bearbeiten</h3>
      <p>Neuen Ansprechpartner hinzufügen oder vorhanden Bearbeiten:</p>
      <form method="POST">
      	<input name="id" value="<?php echo $id; ?>" style="display:none;"><br>
      	<b>Name:</b><br>
      	<input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $name; ?>"><br>
      	<b>E-Mail:</b><br>
      	<input type="text" name="mail" class="form-control" placeholder="E-Mail Adresse" value="<?php echo $mail; ?>"><br>
            <b>Topics:</b><br>
            <input type="text" name="topics" id="topics" class="tags" value="<?php echo $topics; ?>">
<script type="text/javascript">
$('#topics').tagsInput({
      'width':'100%',
      'autocomplete_url':'/zeitung/topiclist'
});
</script>
      	<b>Weiteres:</b><br>
      	<textarea class="form-control" name="more" rows="10"><?php echo $more; ?></textarea><br>
      	<input type="submit" class="btn btn-default" value="Speichern">
      </form>
      
      

      


    
 <?php include(__DIR__."/../style/bottom2.php"); ?>