


<div class="row align-end">
    <div class="c-xs-12 c-sm-12 c-md-8">

      <div class="box">
        <header><h2><?php echo T_("Charge your account"); ?></h2></header>
        <div class="body">
          <form method="post" autocomplete="off">
            <?php \dash\csrf::html(); ?>
           <div class="input pA5">
            <label class="addon" for="amount-number"><?php echo \lib\currency::unit(); ?></label>
            <input id="amount-number" type="number" name="amount" value="<?php echo \dash\data::amount(); ?>" placeholder='<?php echo T_("Enter an amount to charge your account"); ?>' required min=0 max="9999999999">
            <button class="addon btn primary"><?php echo T_("Checkout"); ?></button>
           </div>
          </form>
        </div>
      </div>
    </div>

    <div class="c-xs-12 c-sm-12 c-md-4">
      <div class="stat x120 green">
        <h3><?php echo T_("Your credit"); ?> <i class="sf-credit-card"></i></h3>
        <div class="val"><?php echo \dash\fit::number(\dash\data::userCash()); ?> <small><?php echo \lib\currency::unit(); ?></small></div>
      </div>
    </div>

  </div>

<?php if(\dash\data::history() && is_array(\dash\data::history())) {?>
    <h3 id="billing-history" class="pA10"><?php echo T_("Billing History"); ?></h3>

    <ul class="items">

<?php foreach (\dash\data::history() as $key => $value) {?>
      <li>
         <a class="item f align-center"<?php
if(a($value, 'token'))
{
  echo 'href="';
  echo \dash\url::kingdom(). '/pay/'. a($value, 'token');
  echo '"';
}

?>>
<?php if(isset($value['verify']) && $value['verify']) {?>
          <i class="sf-check fc-green"></i>
<?php }else{ ?>
          <i class="sf-times fc-red"></i>
<?php } //endif ?>
          <div class="key"><?php echo a($value, 'title'); ?></div>

<?php
if(isset($value['plus']) && $value['plus'])
{
  echo '<div class="value">';
  echo \dash\fit::number($value['plus']);
  echo ' '. \lib\currency::unit();
  echo '</div>';
  echo '<i class="sf-plus-circle fc-green"></i>';
}
elseif(isset($value['minus']) && $value['minus'])
{
  echo '<div class="value">';
  echo \dash\fit::number($value['minus']);
  echo ' '. \lib\currency::unit();
  echo '</div>';
  echo '<i class="sf-minus-circle fc-mute"></i>';
}
?>
          <time class="value s0" datetime='<?php echo \dash\fit::text(a($value, 'datecreated')); ?>'><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></time>
         </a>
      </li>
<?php }//endfor ?>

    </ul>

    <?php \dash\utility\pagination::html(); ?>

<?php }else{ ?>

<p class="msg info2 txtC fs14"><?php echo T_("You are not have payment history yet!"); ?></p>

<?php } //endif ?>


