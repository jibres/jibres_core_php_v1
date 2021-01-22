<form method="post" autocomplete="off">
<div class="avand-sm">
	<div class="box">
		<div class="body">
			<label for="displayname"><?php echo T_("Name"); ?> <b class="fc-red">*</b></label>
			<div class="input">
			  <input type="text" name="displayname" id="displayname"  maxlength='50' required>
			</div>
	        <label for="mobile"><?php echo T_("Mobile"); ?></label>
			<div class="input">
			  <input type="tel" name="mobile" id="mobile" placeholder='<?php echo T_("Like 09120123456"); ?>' maxlength='20' data-format="mobile-enter" required>
			</div>
			<label for="permission"><?php echo T_("Permission") ?></label>
				<select name="permission" class="select22" id="permission">
			<option value="" readonly><?php echo T_("Please choose a permission"); ?></option>
			<option value="admin" <?php if(\dash\data::dataRowMember_permission() == 'admin')  { echo 'selected'; }?>><?php echo T_("Administrator"); ?></option>
			<?php if(\dash\data::permGroup()) {?>
				<?php foreach (\dash\data::permGroup() as $key => $value) {?>
					<option value="<?php echo $value; ?>" <?php if(\dash\data::dataRowMember_permission() == $value)  { echo 'selected'; }?> > <?php echo $value; ?></option>
				<?php } ?>
			<?php } ?>
		</select>
		</div>
		<footer class="txtRa">
			<button class="btn master"><?php echo T_("Add") ?></button>
		</footer>
	</div>
</div>
</form>