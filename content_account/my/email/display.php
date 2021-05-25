
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

  <?php if(\dash\data::myList_primary()) {?>
  <label><?php echo T_("Primary Email") ?></label>
    <nav class="items long ltr txtL">
     <ul>
      <?php foreach (\dash\data::myList_primary() as $key => $value) {?>
       <li>
        <a class="item f">
          <i class="sf-envelope s0"></i>
          <div class="key txtB"><?php echo a($value, 'email');?></div>
          <i data-confirm data-data='{"remove":"remove","id":"<?php echo a($value, 'id') ?>"}' class="sf-trash fc-red fs14"></i>
        </a>
       </li>
      <?php } //endfor ?>
     </ul>
   </nav>
  <?php } //eneif ?>

   <?php if(\dash\data::myList_verify()) {?>
    <label><?php echo T_("Verified Email") ?></label>
    <nav class="items long ltr txtL">
     <ul>
      <?php foreach (\dash\data::myList_verify() as $key => $value) {?>
       <li>
        <a class="item f" >
          <i class="sf-mail s0"></i>
          <div class="key"><?php echo a($value, 'email');?></div>
          <i class="sf-asterisk fc-blue" data-title="<?php echo T_("Set as primary email") ?>" data-confirm data-data='{"primary":"primary","id":"<?php echo a($value, 'id') ?>"}' title="<?php echo T_("Set as primary email") ?>"></i>
          <i data-confirm  data-data='{"remove":"remove","id":"<?php echo a($value, 'id') ?>"}' class="sf-trash fc-red fs14"></i>
        </a>
       </li>
      <?php } //endfor ?>
     </ul>
   </nav>
  <?php } //eneif ?>

   <?php if(\dash\data::myList_other()) {?>
    <label><?php echo T_("Pending verification") ?></label>
    <nav class="items long ltr txtL">
     <ul>
      <?php foreach (\dash\data::myList_other() as $key => $value) {?>
       <li>
        <a class="item f" >
          <i class="sf-mail s0"></i>
          <div class="key"><?php echo a($value, 'email');?></div>
          <?php if(a($value, 'can_verify_again')) {?>
          <i class="sf-repeat fc-blue" data-title="<?php echo T_("Send verify email") ?>" data-confirm data-data='{"verify":"verify","id":"<?php echo a($value, 'id') ?>"}' title="<?php echo T_("Send verify email") ?>"></i>
          <div class="value s0 fc-blue"><?php echo T_("Resend") ?></div>
          <?php }else{ ?>
          <div  class="value s0"><?php echo T_("Verify email sent") ?></div>
          <?php } //endif ?>
          <i data-confirm data-data='{"remove":"remove","id":"<?php echo a($value, 'id') ?>"}' class="sf-trash fc-red fs14"></i>
        </a>
       </li>
      <?php } //endfor ?>
     </ul>
   </nav>
  <?php } //eneif ?>
</div>
