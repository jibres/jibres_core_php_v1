<?php if(\dash\data::dataRowMember_status() === 'filter') {?>

<div class="msg warn txtC txtB fs14"><?php echo T_("The user was blocked"); ?></div>

<?php  }elseif(\dash\data::dataRowMember_status() === 'removed') {?>

<div class="msg danger txtC txtB fs14"><?php echo T_("The user was removed"); ?></div>

<?php } ?>

  <div class="f">

   <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'glance') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/glance?id=<?php echo \dash\request::get('id'); ?>' data-shortkey="49ctrlshift">
     <div class="statistic">
      <div class="value"><i class="sf-rocket"></i></div>
      <div class="label"><?php echo T_("Glance"); ?> <kbd class=" hide mT5">Shift+1</kbd></div>
     </div>
    </a>
   </div>

   <div class="c s6">
    <a class="dcard <?php if(in_array(\dash\url::child(), ['general','avatar','social','contact','identification','education'])) { echo 'active'; }?>" href='<?php echo \dash\url::this(); ?>/general?id=<?php echo \dash\request::get('id'); ?>' data-shortkey="50ctrlshift">
     <div class="statistic">
      <div class="value"><i class="sf-user fc-blue"></i></div>
      <div class="label"><?php echo T_("Profile"); ?> <kbd class=" hide mT5">Shift+2</kbd></div>
     </div>
    </a>
   </div>

   <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'billing') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/billing?id=<?php echo \dash\request::get('id'); ?>&action=list' data-shortkey="51ctrlshift" >
     <div class="statistic">
      <div class="value"><i class="sf-credit-card fc-orange"></i></div>
      <div class="label"><?php echo T_("Billing"); ?> <kbd class=" hide mT5">Shift+3</kbd></div>
     </div>
    </a>
   </div>

   <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'legal') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/legal?id=<?php echo \dash\request::get('id'); ?>&action=list' data-shortkey="51ctrlshift" >
     <div class="statistic">
      <div class="value"><i class="sf-user-5 fc-red"></i></div>
      <div class="label"><?php echo T_("Legal"); ?> <kbd class=" hide mT5">Shift+3</kbd></div>
     </div>
    </a>
   </div>

   <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'ticket') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/ticket?id=<?php echo \dash\request::get('id'); ?>' data-shortkey="52ctrlshift" >
     <div class="statistic">
      <div class="value"><i class="sf-life-ring fc-green"></i></div>
      <div class="label"><?php echo T_("Ticket"); ?> <kbd class=" hide mT5">Shift+4</kbd></div>
     </div>
    </a>
   </div>

   <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'security') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/security?id=<?php echo \dash\request::get('id'); ?>' data-shortkey="53ctrlshift" >
     <div class="statistic tail">
      <div class="value"><i class="sf-lock fc-red"></i></div>
      <div class="label"><?php echo T_("Security"); ?> <kbd class=" hide mT5">Shift+5</kbd></div>
     </div>
    </a>
   </div>

      <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'address') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/address?id=<?php echo \dash\request::get('id'); ?>' data-shortkey="54ctrlshift" >
     <div class="statistic tail">
      <div class="value"><i class="sf-pin"></i></div>
      <div class="label"><?php echo T_("Address"); ?> <kbd class=" hide mT5">Shift+6</kbd></div>
     </div>
    </a>
   </div>

   <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'description') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/description?id=<?php echo \dash\request::get('id'); ?>' data-shortkey="55ctrlshift" >
     <div class="statistic tail">
      <div class="value"><i class="sf-list-ul"></i></div>
      <div class="label"><?php echo T_("Description"); ?> <kbd class=" hide mT5">Shift+7</kbd></div>
     </div>
    </a>
   </div>

  <div class="c s6">
    <a class="dcard <?php if(\dash\url::child() == 'log') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>/log?id=<?php echo \dash\request::get('id'); ?>' data-shortkey="56ctrlshift" >
     <div class="statistic tail">
      <div class="value"><i class="sf-camera-surveillance-1"></i></div>
      <div class="label"><?php echo T_("Log"); ?> <kbd class=" hide mT5">Shift+8</kbd></div>
     </div>
    </a>
   </div>




  </div>
