




<?php require_once(root. 'content_crm/member/pageSteps.php'); ?>


<div class="f">
 <div class="cauto s12 pA5">
<?php require_once(root. 'content_crm/member/psidebar.php'); ?>

 </div>
 <div class="c s12 pA5">
	<form class="cbox" method="post" enctype="multipart/form-data" autocomplete="off">
		<div class="input preview">
		 <input type="file" accept="image/gif, image/jpeg, image/png" name="avatar" id="avatar1" data-preview data-max="500">
		 <label for="avatar1" title='<?php echo T_("Set your avatar"); ?>'>
		    <?php if(\dash\data::dataRowMember_avatar()) {?><img src="<?php echo \dash\data::dataRowMember_avatar(); ?>"><?php } ?>
		 </label>
		</div>
		<?php if(\dash\data::dataRowMember_avatar_raw()) {?>

			<div class="f">
				<div class="c"><button class="btn primary block mT20"><?php echo T_("Save"); ?></button></div>
				<div class="cauto mLa5">
					<button class="btn mT20 danger block" name="btn" value="remove"><?php echo T_("Remove"); ?></button>
				</div>
			</div>

		<?php }else{ ?>

			<button class="btn primary block mT20"><?php echo T_("Save"); ?></button>
		<?php } ?>
	</form>
 </div>
</div>




