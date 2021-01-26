<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<div class="avand-md">
	<form class="box" method="post" autocomplete="off">
		<header><h2><?php echo T_("User business Setting") ?></h2></header>
		<div class="body">
			<label for="businesscount"><?php echo T_("Count allow user create business"); ?></label>
			<div class="input">
				<input type="text" name="businesscount" id="businesscount" value="<?php echo \dash\data::dataRowMember_businesscount(); ?>" data-format='number' maxlength="10" placeholder='<?php echo \dash\data::defaultBusinessCount(); ?>'>
			</div>
		</div>

		<footer class="txtRa">
			<button class="btn primary" name="btn" value="add"><?php echo T_("Save"); ?></button>
		</footer>

	</form>

</div>
