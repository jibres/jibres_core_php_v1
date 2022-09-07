<?php
$data = \dash\data::dataRow();
$smsMeta = \dash\data::smsMeta();
?>
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
      <li>
      <a class="f item">
          <div class="key"><?php echo T_("Send ID") ?></div>
          <div class="value font-bold"><?php echo \dash\fit::text(\dash\data::dataRow_jibres_sms_id()); ?></div>
          <div class="go detail"></div>
      </a>
      </li>
  </ul>
</nav>

<?php if(a($smsMeta, 'resend-id')) {?>
<nav class="items">
  <ul>
     <li>
      <a class="f item" href="<?php echo \dash\url::that(). '?id='. $smsMeta['resend-id'] ?>">
        <div class="key"><?php echo T_("Show resended message") ?></div>
        <div class="value font-bold"><?php echo \dash\fit::text($smsMeta['resend-id']) ?></div>
        <div class="go"></div>
      </a>
     </li>
   </ul>
</nav>
<?php } //endif ?>
<?php if(a($smsMeta, 'resendfrom')) {?>
<nav class="items">
  <ul>
     <li>
      <a class="f item" href="<?php echo \dash\url::that(). '?id='. $smsMeta['resendfrom'] ?>">
        <div class="key"><?php echo T_("Resended from") ?></div>
        <div class="value font-bold"><?php echo \dash\fit::text($smsMeta['resendfrom']) ?></div>
        <div class="go"></div>
      </a>
     </li>
   </ul>
</nav>
<?php } //endif
 if(\dash\data::dataRow_status() === 'moneylow')
{
  require_once(root. 'content_crm/sms/display-resend.php');
}
?>

<?php if(a($data, 'message')) { ?>
    <div class="box">
        <div class="pad">
            <p><?php  echo nl2br(a($data, 'message')); ?></p>
        </div>
    </div>
<?php } //endif ?>

