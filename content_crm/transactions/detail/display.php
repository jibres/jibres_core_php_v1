<nav class="items">
  <ul>

      <li>
      <a class="f item">
        <div class="key"><?php echo T_("ID") ?></div>
        <div class="value txtB"><?php echo \dash\fit::text(\dash\data::dataRow_id()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>
    <li>
      <a class="f item">
        <div class="key"><?php echo T_("Title") ?></div>
        <div class="value txtB"><?php echo \dash\data::dataRow_title(); ?></div>
        <div class="go detail"></div>
      </a>
     </li>

     <?php if(\dash\data::dataRow_plus()) {?>
     <li>
      <a class="f item">
        <div class="key"><?php echo T_("Plus Amount") ?></div>
        <div class="value txtB">+ <?php echo \dash\fit::number(\dash\data::dataRow_plus()); ?></div>
        <div class="go detail ok"></div>
      </a>
     </li>
   <?php } //endif ?>
     <?php if(\dash\data::dataRow_minus()) {?>
     <li>
      <a class="f item">
        <div class="key"><?php echo T_("Minus Amount") ?></div>
        <div class="value txtB">- <?php echo \dash\fit::number(\dash\data::dataRow_minus()); ?></div>
        <div class="go detail nok"></div>
      </a>
     </li>
   <?php } //endif ?>
    <?php if(\dash\data::dataRow_factor_id()) {?>
     <li>
      <a class="f item" href="<?php echo \dash\url::kingdom(). '/a/order/detail?id='. \dash\data::dataRow_factor_id() ?>">
        <div class="key"><?php echo T_("Pay for order") ?></div>
        <div class="value txtB"><?php echo T_("Order #:val", ["val" => \dash\data::dataRow_factor_id()]) ?></div>
        <div class="go "></div>
      </a>
     </li>
   <?php } //endif ?>


    <li>
      <a class="f item">
        <div class="key"><?php echo T_("Successfull payment") ?></div>
        <div class="value txtB"><?php if(\dash\data::dataRow_verify()) { echo T_("Yes"); }else{echo T_("No");} ?></div>
        <div class="go <?php if(\dash\data::dataRow_verify()) { echo 'check ok'; }else{echo 'times nok';} ?>"></div>
      </a>
     </li>

    <li>
      <a class="f item">
        <div class="key"><?php echo T_("Date created") ?></div>
        <div class="value txtB"><?php echo \dash\fit::date_time(\dash\data::dataRow_datecreated()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>
  </ul>
</nav>
