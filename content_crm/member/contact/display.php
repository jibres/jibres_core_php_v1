


<?php require_once(root. 'content_crm/member/pageSteps.php'); ?>

<div class="f">
 <div class="cauto s12 pA5">
	<?php require_once(root. 'content_crm/member/psidebar.php'); ?>

 </div>
 <div class="c s12 pA5">
	<form class="cbox" method="post" autocomplete="off">




		<label for="phone"><?php echo T_("Phone"); ?></label>
		<div class="input">
		  <input type="tel" name="phone" id="phone" placeholder='<?php echo T_("Like"); ?> 02536505281' value="<?php echo \dash\data::dataRowMember_phone(); ?>" maxlength='50'>
		</div>

		<label for="email"><?php echo T_("Email"); ?></label>
		<div class="input">
		  <input type="text" name="email" id="email" placeholder='<?php echo T_("Like abc@example.com"); ?>' value="<?php $email = \dash\data::dataRowMember_detail(); echo @$email['email']; ?>" maxlength='30'>
		</div>


	 <button class="mT25 btn primary block"><?php echo T_("Save"); ?></button>
	</form>
 </div>
</div>
