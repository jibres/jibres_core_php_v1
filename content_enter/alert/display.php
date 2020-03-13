
<p class="txtC "><?php echo \dash\data::alertMsg(); ?></p>
<a class="link txtC " id="directLink"  href='<?php echo \dash\data::alertLink(); ?>'><?php echo \dash\data::alertButton(); ?></a>

<script>
setTimeout(function()
{
  document.getElementById('directLink').click();
}, 2000);
</script>