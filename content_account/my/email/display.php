
<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="body">
        <?php \dash\utility\hive::html(); ?>
        <label for="email"><?php echo T_("Email"); ?></label>
        <div class="input">
          <input type="email" name="email" id="email" placeholder='<?php echo T_("like"); ?> abc@example.com' maxlength='100'>
          <span class="addon"><i class="sf-mail"></i></span>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Save"); ?></button>
      </footer>
    </div>
  </form>

  <?php if(\dash\data::dataTable() && is_array(\dash\data::dataTable())) {?>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
      <div class="box">
        <div class="body">
          <div class="txtL ltr txtB fs14"><?php echo \dash\get::index($value, 'email') ?> <?php if(\dash\get::index($value, 'verify')) {?><i class="sf-check fc-green"></i><?php }// endif ?></div>
          <?php if(!\dash\get::index($value, 'verify')) {?>

            <div class="btn link" data-confirm data-data='{"verify":"verify","email":"<?php echo \dash\get::index($value, 'email') ?>" }'><?php echo T_("Send verify email") ?></div>

          <?php } //endif ?>
          <?php if(\dash\get::index($value, 'verify')) {?>
            <?php if(!\dash\get::index($value, 'primary') ) {?>
              <div class="btn link" data-confirm data-data='{"primary":"primary","email":"<?php echo \dash\get::index($value, 'email') ?>" }'><?php echo T_("Set as primary email") ?></div>
            <?php }else{ ?>
              <div class="badge success"><?php echo T_("Primary email") ?></div>
            <?php } //endif ?>
          <?php } //endif ?>
        </div>
        <footer>
          <div class="f">
            <div class="cauto"><div data-confirm data-data='{"remove":"remove","email":"<?php echo \dash\get::index($value, 'email') ?>" }'><i class="sf-trash fc-red fs14"></i></div></div>
            <div class="c"></div>

          </div>
        </footer>
      </div>
    <?php }//endfor ?>
  <?php } // endif ?>
</div>

