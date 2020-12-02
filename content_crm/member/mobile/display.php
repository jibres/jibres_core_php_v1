<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<div class="avand-sm">
	<form method="post" autocomplete="off">
		<div class="box">
			<div class="body">
				<label for="mobile"><?php echo T_("Mobile") ?></label>
				<div class="input">
					<input type="tel" name="mobile" value="<?php echo \dash\data::dataRowMember_mobile() ?>" data-format='mobile-enter'>
				</div>
			</div>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Save") ?></button>
			</footer>
		</div>
	</form>
</div>