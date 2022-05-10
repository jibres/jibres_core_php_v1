<div class="f justify-center">
 <div class="c9 m12 s12">
  <div class="box p-4">
   <div class="msg minimal pLR20-f fs16 font-bold ltr text-left success"><?php echo \dash\data::domainDetail_name() ?></div>
    <?php if(\dash\data::dataTable()) {?>
     	<?php foreach (\dash\data::dataTable() as $key => $value) {?>

     		<div class="f msg <?php echo a($value, 'class'); ?>">
     			<div class="cauto mRa10"><?php echo a($value, 'icon'); ?></div>
     			<div class="cauto"><?php echo a($value, 'taction'); ?><br><b><?php echo a($value, 'meta'); ?></b></div>
     			<div class="c"></div>
     			<div class="cauto mLR10">
     				<small>
     				<?php echo \dash\fit::date_human(a($value, 'datecreated')); ?>
     				</small>
     			</div>
     			<div class="cauto">
     				<?php echo \dash\fit::date_time(a($value, 'datecreated')); ?>
     			</div>
     		</div>

     	<?php } //endfor ?>

    <?php }else{ ?>

      <div class="alert-warning"><?php echo T_("No action history founded"); ?></div>
    <?php } //endif ?>



  </div>
 </div>
</div>
