
<?php require_once(root. 'content_crm/member/pageSteps.php'); ?>

<div class="f">
 <div class="cauto s12 pA5">
	<?php require_once(root. 'content_crm/member/psidebar.php'); ?>

 </div>
 <div class="c s12 pA5">
	<form class="cbox" method="post" enctype="multipart/form-data" autocomplete="off">

<?php
$detail = \dash\data::dataRowMember_detail();
?>



			<h4 class="pT15"><?php echo T_("Thumb"); ?></h4>
			<label for="file1"><?php echo T_("ID card image"); ?></label>
			<div class="input ">
			 <input type="file" accept="image/gif, image/jpeg, image/png" name="file1" id="file1" data-preview data-max="500">
			</div>

		    <?php if(isset($detail['file1'])) {?><a href="<?php echo \dash\get::index($detail, 'file1'); ?>" target="_blank"><img class="size-we200 block mLRa" src="<?php echo \dash\get::index($detail, 'file1'); ?>"></a><?php } // endif ?>

			<label for="file2"><?php echo T_("National card photo"); ?></label>
			<div class="input ">
			 <input type="file" accept="image/gif, image/jpeg, image/png" name="file2" id="file2" data-preview data-max="500">
			</div>

		    <?php if(isset($detail['file2'])) {?><a href="<?php echo \dash\get::index($detail, 'file2'); ?>" target="_blank"><img class="size-we200 block mLRa" src="<?php echo \dash\get::index($detail, 'file2'); ?>"></a><?php } // endif ?>



			<button class="btn block primary"><?php echo T_("Save"); ?></button>
	</form>
 </div>
</div>

