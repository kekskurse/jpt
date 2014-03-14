<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/intro.js/0.5.0/intro.js"></script>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/intro.js/0.5.0/introjs.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/intro.js/0.5.0/introjs-rtl.css" rel="stylesheet">
<style type="text/css">
.search
{
	width:20px;
}
.avatar{ /* selector for a picture which is "inside" the avatar class */
    display: block; /* a picture is being displayed as a block, by a width it will be equal to the parent(in the div) */
    border: 0; /* zero border */
    margin: 0; /* external margin is lacking */
    padding:0px;
    border-radius: 50%; /* read above */
}
.label
{

}
</style>
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="/">JPT<span style="color:red">V</span>2</a>
				</div>
				<ul class="nav navbar-nav">
        <li class="dropdown" data-position="right" data-step="4" data-intro="Hier kannst du dein Profil bearbeiten.">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="avatar" src="http://www.gravatar.com/avatar/<?php echo md5($_SESSION["mail"]); ?>" height="20" alt="avatar" /></a>
          <ul class="dropdown-menu">
          	<li><a href="#" onclick="introJs().start();">Anleitung</a></li>
            <li class="divider"></li>
            <li><a href="/logout">Ausloggen</a></li>
          </ul>
        </li>
      </ul>
				<ul class="nav navbar-nav" data-position="right" data-step="3" data-intro="Hier ist die &uuml;bersicht deiner Arbeitsbereiche">
        <li id="linkLoKo"><a href="/loko/contact">LoKo</a></li>
        <li id="linkZeitung"><a href="/zeitung/contact">Zeitung</a></li>
        <!--<li id="linkUser"><a href="/user/">User</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gruppen <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">LO Berlin</a></li>
            <li><a href="#">Crew Verwaltung</a></li>
            <li><a href="#">Crew Bildung</a></li>
            <li class="divider"></li>
            <li><a href="#"><i>Keine Vorstaende</i></a></li>
            <li class="divider"></li>
            <li><a href="#">Poststelle</a></li>
            <li><a href="#">IT</a></li>
            <li class="divider"></li>
            <li><a href="#">Neue Gruppe</a></li>
          </ul>
        </li>!-->
      </ul>
				<ul class="nav navbar-nav navbar-right" data-position="left" data-step="2" data-intro="Hier findest du eine &uuml;bersicht der Aktionen f&uuml;r diese Seite">
					<?php if(isset($config["actionMenu"])) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i></a>
						<ul class="dropdown-menu">
							<?php
							foreach($config["actionMenu"] as $entry)
							{
								echo "<li><a href='".$entry["href"],"'>".$entry["name"]."</a></li>";
							}
							?>
							<!--<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
							<li class="divider"></li>
							<li><a href="#">One more separated link</a></li>!-->
						</ul>
					</li><?php } ?>
				</ul>
				<?php if($config["search"]) { ?>
				<form class="navbar-form navbar-right form-search" role="search" data-position="left" data-step="1" data-intro="&Uuml;ber die Suche kannst du den Inhalt auf der aktuellen Seite beeinflussen.">
					<div class="form-group">
						<input type="text" class="form-control search" style="width:35px;<?php if(isset($q)&&!empty($q)){ echo 'width:250px;'; } ?>" id="searchBox" placeholder="Suche" value="<?php if(isset($q)) { echo $q; } ?>">
					</div>
				</form>
				<?php } ?>
				
			</div>
		</nav>
	</div>
	<div class="container-fluid" style="padding-top:70px;">
	<div class="row">
			<div class="col-md-2">
<?php 
if($config["menu"]!=null)
{
	include(__DIR__."/../".$config["menu"]."/menu.inc.php");
}
else
{
	echo "<i>Keine Menüpunkte</i>";
}
?>
			</div>
			<div class="col-md-10">
				<?php if(isset($config["breadcrumb"])){ ?>
				<ol class="breadcrumb" data-position="bottom" data-step="6" data-intro="Hier siehst du wo du dich grade aufh&auml;lst.">
					<?php
					foreach($config["breadcrumb"] as $entry)
					{
						echo "<li><a href='";
						if(isset($entry["href"]))
						{
							echo $entry["href"];
						}
						else
						{
							echo "#";
						}
						echo "'>".$entry["name"]."</a></li>";
					}
					?>
</ol><?php } ?>