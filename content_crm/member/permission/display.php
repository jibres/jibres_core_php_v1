<div class="avand-md">
	<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
	<form method="post" autocomplete="off">
		<div class="box">
			<div class="body">
				<label for="permission"><?php echo T_("Permission"); ?></label>
				<select name="permission" class="select22" id="permission">
					<option value="" readonly><?php echo T_("No permission"); ?></option>
					<option value="admin" <?php if(\dash\data::dataRowMember_permission() == 'admin')  { echo 'selected'; }?>><?php echo T_("Administrator"); ?></option>
					<?php if(\dash\data::permGroup()) {?>
						<?php foreach (\dash\data::permGroup() as $key => $value) {?>
							<option value="<?php echo $value; ?>" <?php if(\dash\data::dataRowMember_permission() == $value)  { echo 'selected'; }?> > <?php echo $value; ?></option>
						<?php } ?>
					<?php } ?>
				</select>
			</div>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Save") ?></button>
			</footer>
		</div>
	</form>
</div>