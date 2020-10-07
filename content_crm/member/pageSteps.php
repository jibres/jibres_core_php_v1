<?php if(\dash\data::dataRowMember_status() === 'filter') {?>

<div class="msg warn txtC txtB fs14"><?php echo T_("The user was blocked"); ?></div>

<?php  }elseif(\dash\data::dataRowMember_status() === 'removed') {?>

<div class="msg danger txtC txtB fs14"><?php echo T_("The user was removed"); ?></div>

<?php } ?>

  <div class="f">

   <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'glance') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/glance?id=<?php echo \dash\request::get('id'); ?>'>
     <div class="statistic">
      <div class="value"><i class="sf-rocket"></i></div>
      <div class="label"><?php echo T_("Glance"); ?></div>
     </div>
    </a>
   </div>

   <div class="c s6">
    <a class="dcard <?php if(in_array(\dash\url::child(), ['general','avatar','social','contact','identification','education'])) { echo 'active'; }?>" href='<?php echo \dash\url::this(); ?>/general?id=<?php echo \dash\request::get('id'); ?>'>
     <div class="statistic">
      <div class="value"><i class="sf-user fc-blue"></i></div>
      <div class="label"><?php echo T_("Profile"); ?></div>
     </div>
    </a>
   </div>

   <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'billing') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/billing?id=<?php echo \dash\request::get('id'); ?>&action=list'>
     <div class="statistic">
      <div class="value"><i class="sf-credit-card fc-orange"></i></div>
      <div class="label"><?php echo T_("Billing"); ?></div>
     </div>
    </a>
   </div>

   <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'legal') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/legal?id=<?php echo \dash\request::get('id'); ?>&action=list'>
     <div class="statistic">
      <div class="value"><i class="sf-user fc-red"></i></div>
      <div class="label"><?php echo T_("Legal"); ?></div>
     </div>
    </a>
   </div>

   <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'ticket') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/ticket?id=<?php echo \dash\request::get('id'); ?>'>
     <div class="statistic">
      <div class="value"><i class="sf-life-ring fc-green"></i></div>
      <div class="label"><?php echo T_("Ticket"); ?></div>
     </div>
    </a>
   </div>

   <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'security') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/security?id=<?php echo \dash\request::get('id'); ?>'>
     <div class="statistic">
      <div class="value"><i class="sf-lock fc-red"></i></div>
      <div class="label"><?php echo T_("Security"); ?></div>
     </div>
    </a>
   </div>

      <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'address') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/address?id=<?php echo \dash\request::get('id'); ?>'>
     <div class="statistic">
      <div class="value"><i class="sf-pin"></i></div>
      <div class="label"><?php echo T_("Address"); ?></div>
     </div>
    </a>
   </div>

   <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'description') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/description?id=<?php echo \dash\request::get('id'); ?>'>
     <div class="statistic">
      <div class="value"><i class="sf-list-ul"></i></div>
      <div class="label"><?php echo T_("Description"); ?></div>
     </div>
    </a>
   </div>

  <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'log') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/log?id=<?php echo \dash\request::get('id'); ?>'>
     <div class="statistic">
      <div class="value"><i class="sf-camera-surveillance"></i></div>
      <div class="label"><?php echo T_("Log"); ?></div>
     </div>
    </a>
   </div>

   <?php if(!\dash\engine\store::inStore()) {?>
  <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'business') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/business?id=<?php echo \dash\request::get('id') ?>' >
     <div class="statistic teal">
      <div class="value"><i class="sf-shop"></i></div>
      <div class="label"><?php echo T_("Business"); ?></div>
     </div>
    </a>
   </div>
 <?php } //endif ?>




  </div>
