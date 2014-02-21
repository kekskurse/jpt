</div>
	</div>
	<script>
	$('.search').focus(function()
{
    /*to make this flexible, I'm storing the current width in an attribute*/
    $(this).attr('data-default', $(this).width());
    $(this).animate({ width: 250 }, 'slow');
    $("#searchbtn").show();
}).blur(function()
{
    /* lookup the original width */
    if($(this).val()=="")
    {
        var w = $(this).attr('data-default');
        $(this).animate({ width: 35 }, 'slow');
    }
});

<?php
foreach($config["aktiv"] as $aktiv)
{
    echo '$("#link'.$aktiv.'").addClass("active");';
    echo "console.log('".$aktiv."');";
}
?>

//introJs().start();
	</script>
</body>