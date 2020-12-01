<div class="cbox normal">

  <div class="vcard">
  <a href='<?php echo \dash\url::this(); ?>/avatar?id=<?php echo \dash\request::get('id'); ?>'>
  	<?php if(\dash\data::dataRowMember_avatar()) {?>

    <img src="<?php echo \dash\data::dataRowMember_avatar(); ?>">

  	<?php }else{ ?>

    <img src="<?php echo \dash\url::cdn(); ?>/siftal/images/useful/user1.png">
  	<?php } ?>
  </a>
  <div class="content">
    <div class="header"><?php echo \dash\data::dataRowMember_firstname(); ?> <b><?php echo \dash\data::dataRowMember_lastname(); ?></b></div>
    <div class="meta"><span><?php echo \dash\data::dataRowMember_father(); ?></span></div>

    <?php if (\dash\data::dataRowMember_mobile()) {?>
    <div class="desc"><i class="sf-mobile fs2"></i><a href="<?php echo \dash\url::this(); ?>/contact?id=<?php echo \dash\request::get('id'); ?>"><?php echo \dash\fit::mobile(\dash\data::dataRowMember_mobile()); ?></a></div>
    <?php } ?>
  </div>

 </div>

   <a class="btn block mTB10" href='<?php echo \dash\url::this(); ?>/general?id=<?php echo \dash\request::get('id'); ?>'><?php echo T_("General Detail"); ?></a>
   <a class="btn block mTB10" href='<?php echo \dash\url::this(); ?>/identification?id=<?php echo \dash\request::get('id'); ?>'><?php echo T_("Identification detail"); ?></a>
   <a class="btn block mTB10" href='<?php echo \dash\url::this(); ?>/contact?id=<?php echo \dash\request::get('id'); ?>'><?php echo T_("Contact information"); ?></a>
   <a class="btn block mTB10" href='<?php echo \dash\url::this(); ?>/social?id=<?php echo \dash\request::get('id'); ?>'><?php echo T_("Social network"); ?></a>


</div>