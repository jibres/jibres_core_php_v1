<div class="avand-md">
	<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
	<form method="post" autocomplete="off">
		<div class="box">
			<div class="body">
				<label for="email"><?php echo T_("Email") ?></label>
				<div class="input">
					<input type="email" name="email" value="<?php echo \dash\data::dataRowMember_email() ?>">
				</div>
			</div>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Save") ?></button>
			</footer>
		</div>
	</form>
</div>