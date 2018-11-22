<?php snippet('header') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
 <style>
* {
  padding: 0;
  margin: 0;
}
.fit {
  max-width: 100%;
  max-height: 100%;
}
.center {
  display: block;
  margin: auto;
}
body {
	background: black;
	color: white;
}
</style>
<script type="text/javascript" language="JavaScript">
function set_body_height()
{
    var wh = $(window).height() -150;
    $('.fit').attr('style', 'height:' + wh + 'px;');
}
$(document).ready(function() {
    set_body_height();
    $(window).bind('resize', function() { set_body_height(); });
});
</script>
  <main class="main" role="main">

    <div class="text">
      <?php echo $page->text()->kirbytext() ?>
      <?php echo $log ?>
    </div>


  </main>

<?php snippet('footer') ?>