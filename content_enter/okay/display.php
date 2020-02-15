
  <div class='text'>
   <p><?php echo T_("You are logined ;)"); ?></p>
   <p><?php echo T_("Be patient or"); ?> <a href="<?php echo \dash\data::redirectUrl(); ?>" id="okayLink" data-direct><?php echo T_("click here!"); ?></a></p>
  </div>
  <script>
    setTimeout(function()
    {
      document.getElementById('okayLink').click();
    }, 1000);
  </script>
