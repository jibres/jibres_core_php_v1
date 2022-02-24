<?php $data = \dash\data::dataRow(); ?>
<nav class="items">
  <ul>
      <li>
      <a class="f item">
        <div class="key"><?php echo T_("ID") ?></div>
        <div class="value font-bold"><?php echo \dash\fit::text(\dash\data::dataRow_id()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>

     <li>
      <a class="f item">
        <div class="key"><?php echo T_("Mobile") ?></div>
        <div class="value font-bold"><?php echo \dash\fit::mobile(\dash\data::dataRow_mobile()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>

     <?php if(\dash\data::dataRow_line()) {?>
       <li>
      <a class="f item">
        <div class="key"><?php echo T_("Line") ?></div>
        <div class="value font-bold"><?php echo \dash\fit::text(\dash\data::dataRow_line()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>
   <?php } //endif ?>

     <li>
      <a class="f item">
        <div class="key"><?php echo T_("Mode") ?></div>
        <div class="value font-bold"><?php echo T_(\dash\data::dataRow_mode()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>

    <li>
      <a class="f item">
        <div class="key"><?php echo T_("Status") ?></div>
        <div class="value font-bold"><?php echo T_(\dash\data::dataRow_status()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>

     <?php if(\dash\data::dataRow_len()) {?>
         <li>
      <a class="f item">
        <div class="key"><?php echo T_("Length") ?></div>
        <div class="value font-bold"><?php echo \dash\fit::number(\dash\data::dataRow_len()). ' '. T_("Character"); ?></div>
        <div class="go detail"></div>
      </a>
     </li>
   <?php } //endif ?>

     <?php if(\dash\data::dataRow_smscount()) {?>
         <li>
      <a class="f item">
        <div class="key"><?php echo T_("Count sms") ?></div>
        <div class="value font-bold"><?php echo \dash\fit::number(\dash\data::dataRow_smscount()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>
   <?php } //endif ?>

    <li>
      <a class="f item">
        <div class="key"><?php echo T_("Date created") ?></div>
        <div class="value font-bold"><?php echo \dash\fit::date_time(\dash\data::dataRow_datecreated()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>
  </ul>
</nav>
<?php if(a($data, 'message')) { ?>
<div class="box">
  <div class="pad">
      <p><?php  echo nl2br(a($data, 'message')); ?></p>
  </div>
</div>
<?php } //endif ?>
