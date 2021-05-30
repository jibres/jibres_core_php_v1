<?php $bank = \dash\data::bankSetting(); ?>

<form method="post" autocomplete="off">
	<input type="hidden" name="set_parsian" value="1">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">
				<div class="txtC">
					<i class="spay-128-parsian"></i>
				</div>
				<br>
				<div class="ltr">
					<label for="LoginAccount">LoginAccount</label>
					<div class="input">
					  <input type="text" name="LoginAccount" id="LoginAccount" placeholder='LoginAccount' value="<?php echo a($bank, 'parsian','LoginAccount'); ?>" maxlength='300'>
					</div>
				</div>
			</div>
			<footer class="f">
				<?php if(!a($bank, 'parsian', 'empty')) {?>
					<div class="cauto"><div class="linkDel btn" data-confirm data-data='{"set_parsian": 1, "delete" : "delete"}'><?php echo T_("Remove") ?></div></div>
				<?php } //endif ?>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>
			</footer>
		</div>
	</div>
</form>