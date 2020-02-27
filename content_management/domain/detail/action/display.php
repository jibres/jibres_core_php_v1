<?php require_once (root. 'content_management/domain/detail/pageStep.php'); ?>
<div class="f justify-center">
 <div class="c9 m12 s12">
  <div class="cbox">
   <div class="msg minimal pLR20-f fs16 txtB ltr txtL success"><?php echo \dash\data::domainDetail_name() ?></div>
    <?php if(\dash\data::dataTable()) {?>
     	<?php foreach (\dash\data::dataTable() as $key => $value) {?>

     		<div class="f msg <?php echo \dash\get::index($value, 'class'); ?>">
     			<div class="cauto mRa10"><?php echo \dash\get::index($value, 'icon'); ?></div>
     			<div class="cauto"><?php echo \dash\get::index($value, 'taction'); ?></div>
     			<div class="c"></div>
     			<div class="cauto mLR10">
     				<small>
     				<?php echo \dash\fit::date_human(\dash\get::index($value, 'datecreated')); ?>
     				</small>
     			</div>
     			<div class="cauto">
     				<?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?>
     			</div>
     		</div>

     	<?php } //endfor ?>

    <?php }else{ ?>

      <div class="msg warn2"><?php echo T_("No action history founded"); ?></div>
    <?php } //endif ?>



  </div>
 </div>
</div>
