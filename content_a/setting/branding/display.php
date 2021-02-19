<div class="avand-md">
  <form method="post" autocomplete="off">
    <div  class="box">

      <div class="body">

        <div class="switch1 mB20">
          <input type="checkbox" name="removebranding" checked disabled id="removebranding">
          <label for="removebranding"></label>
          <label for="removebranding"><?php echo T_("Remove jibres branding from website and application") ?></label>
        </div>


        <div class="row">
          <?php foreach (\lib\app\plan\branding::price_list() as $key => $value) {?>
          <div class="c-xs-12 c-sm-12 c-md-6">
            <div data-confirm data-data='{"key": "<?php echo a($value, 'key'); ?>"}' class="stat">
              <h3><?php echo \dash\fit::number(a($value, 'price')). ' '. a($value, 'currency_name'); ?></h3>
              <div class="val"><?php echo a($value, 'title'); ?></div>
            </div>
          </div>
        <?php } //endif ?>
        </div>


      </div>
      </div>
   </form>
</div>
