
  <div id="jibresHeader">
   <div class="fit">
    <div class="f">
     <div class="cauto">
      <a class="logo" href='<?php echo \dash\url::sitelang() ?>/'><img <?php
        if (\dash\language::current() === 'fa')
        {
         echo "src='". \dash\url::cdn(). "/logo/fa/svg/Jibres-Logo-fa.svg". "' alt='". T_('Jibres Logo'). "'";
        }
        else
        {
         echo "src='". \dash\url::cdn(). "/logo/en/svg/Jibres-Logo-en.svg". "' alt='". T_('Jibres Logo'). "'";
        }
       ?>><h1><?php echo T_("Jibres"); ?></h1></a>
     </div>
     <nav class="c s0">
     </nav>
     <nav class="cauto">
       <a href="<?php echo \dash\url::kingdom() ?>/"><?php echo T_("Developers Home"); ?></a>
       <a href="<?php echo \dash\url::kingdom() ?>/libraries"><?php echo T_("Libraries"); ?></a>
       <a href="<?php echo \dash\url::kingdom() ?>/guides"><?php echo T_("Guides"); ?></a>
       <a href="<?php echo \dash\url::kingdom() ?>/docs"><?php echo T_("Docs"); ?></a>
     </nav>
    </div>
   </div>
  </div>
