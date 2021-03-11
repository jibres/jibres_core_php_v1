
<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="body">
        <?php \dash\csrf::html(); ?>
        <label for="email"><?php echo T_("Email"); ?></label>
        <div class="input">
          <input type="email" name="email" id="email" placeholder='<?php echo T_("like"); ?> abc@example.com' maxlength='100' <?php if(\dash\data::myEmail()){ echo 'value="'. \dash\data::myEmail(). '"'; } ?>>
          <span class="addon"><i class="sf-mail"></i></span>
        </div>
        <?php if(\dash\request::get('v') == 1) {?>
          <div class="msg"><?php echo T_("You need to verify email after add to your account") ?></div>
        <?php } //endif ?>
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
          <div class="txtL ltr txtB fs14"><?php echo a($value, 'email') ?> <?php if(a($value, 'verify')) {?><i class="sf-check fc-green"></i><?php }// endif ?></div>
          <?php if(!a($value, 'verify')) {?>

            <div class="btn link" data-confirm data-data='{"verify":"verify","email":"<?php echo a($value, 'email') ?>" }'><?php echo T_("Send verify email") ?></div>

          <?php } //endif ?>
          <?php if(a($value, 'verify')) {?>
            <?php if(!a($value, 'primary') ) {?>
              <div class="btn link" data-confirm data-data='{"primary":"primary","email":"<?php echo a($value, 'email') ?>" }'><?php echo T_("Set as primary email") ?></div>
            <?php }else{ ?>
              <div class="badge success"><?php echo T_("Primary email") ?></div>
            <?php } //endif ?>
          <?php } //endif ?>
        </div>
        <footer>
          <div class="f">
            <div class="cauto"><div data-confirm data-data='{"remove":"remove","email":"<?php echo a($value, 'email') ?>" }'><i class="sf-trash fc-red fs14"></i></div></div>
            <div class="c"></div>

          </div>
        </footer>
      </div>
    <?php }//endfor ?>
  <?php } // endif ?>
</div>

