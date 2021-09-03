<?php $lineSetting = \dash\data::lineSetting(); ?>
<section class="f" data-option='website-quote-mode'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set quote show model");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
      <div class="action">
         <select class="select22" name="itemshowmode" id="itemshowmode">
          <option value="simple" <?php if(a($lineSetting, 'detail',  'itemshowmode') == 'simple') { echo 'selected'; } ?> ><?php echo T_("Simple"); ?></option>
          <option value="special" <?php if(a($lineSetting, 'detail',  'itemshowmode') == 'special') { echo 'selected'; } ?> ><?php echo T_("Special"); ?></option>

         </select>
      </div>
  </form>
</section>