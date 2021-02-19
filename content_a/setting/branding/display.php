<div class="avand-md">
    <div  class="box">

      <div class="body">
        <?php
        if(\lib\store::detail('branding'))
        {
          echo '<div class="msg">'. T_("Your branding was expire at :val", ['val' => \dash\fit::date_time(\lib\store::detail('branding'))]). '</div>';
        }
        ?>
        <form method="post" autocomplete="off" data-patch>
          <input type="hidden" name="set" value="set">
        <div class="switch1 mB20">
          <input type="checkbox" name="removebranding" <?php if(\lib\store::branding_time()) { echo ' disabled';} if(\lib\store::branding()) { echo ' checked';} ?> id="removebranding">
          <label for="removebranding"></label>
          <label for="removebranding"><?php echo T_("Show jibres branding from website and application") ?></label>
        </div>
        </form>

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
</div>
