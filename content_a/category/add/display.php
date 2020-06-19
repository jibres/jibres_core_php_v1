<div class="avand-md">
	<form method="post" autocomplete="off">
		<div class="box">
			<div class="body">
				<?php if(\dash\data::dataRow_parent1() || \dash\data::parentList()) {?>

					<div class="mB10">
						<label for='parent'><?php echo T_("Parent"); ?>
						<?php if(\dash\data::dataRow_have_child()) {?> <small class="fc-mute"><?php echo T_("This category have some child and you can not change parent of it"); ?></small> <?php } //endif ?></label>
						<select name="parent" id="parent" class="select22" data-placeholder='<?php echo T_("Select category parent"); ?>' <?php if(\dash\data::dataRow_have_child()) {?> disabled <?php }//endif ?>>
							<option></option>

							<?php if(\dash\data::dataRow_parent1()) {?>
								<option value="0"><?php echo T_("Without category"); ?></option>
							<?php } //endif ?>

							<?php foreach (\dash\data::parentList() as $key => $value) {?>

								<option value="<?php echo \dash\get::index($value, 'id'); ?>" <?php if(isset($value['id']) && $value['id'] == \dash\data::dataRow_last_parent()) { echo 'selected'; } ?>><?php echo \dash\get::index($value, 'full_title'); ?></option>
							<?php }//endfor ?>

						</select>
					</div>

				<?php } //endif ?>


				<label for="icatname"><?php echo T_("Title"); ?></label>
				<div class="input">
					<input type="text" name="cat" id="icatname" placeholder='<?php echo T_("Category name"); ?>'  autofocus maxlength='50' minlength="1" required>
				</div>
			</div>
			<footer class="txtRa">
				<button class="btn primary"><?php echo T_("Add"); ?></button>
			</footer>
		</div>
	</form>
</div>
