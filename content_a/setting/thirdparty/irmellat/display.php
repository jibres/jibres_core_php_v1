<?php $bank = \dash\data::bankSetting(); ?>

<form method="post" autocomplete="off">
	<input type="hidden" name="set_mellat" value="1">
	<div class="avand-sm">
		<div class="box">
			<div class="pad">
				<div class="txtC">
					<i class="spay-128-mellat"></i>
				</div>
				<br>
				<div class="switch1">
				 <input type="checkbox" name="mellat" id="mellat" <?php if(a($bank, 'mellat', 'status')) { echo 'checked';} ?> >
				 <label for="mellat"></label>
				 <label for="mellat"><?php echo T_("Enable mellat payment"); ?></label>
				</div>

				<div class="ltr mT10" data-response='mellat' <?php if(a($bank, 'mellat', 'status')) { /* nothing */}else{ echo ' data-response-hide ';} ?> >



						<label for="TerminalId">TerminalId</label>
						<div class="input">
							<input type="text" name="TerminalId" id="TerminalId" placeholder='TerminalId' value="<?php echo a($bank, 'mellat','TerminalId'); ?>" maxlength='300'>
						</div>

						<label for="UserName">UserName</label>
						<div class="input">
							<input type="text" name="UserName" id="UserName" placeholder='UserName' value="<?php echo a($bank, 'mellat','UserName'); ?>" maxlength='300'>
						</div>

						<label for="UserPassword">UserPassword</label>
						<div class="input">
							<input type="password" name="UserPassword" id="UserPassword" placeholder='UserPassword' value="<?php echo a($bank, 'mellat','UserPassword'); ?>" maxlength='300'>
						</div>
					</div>

			</div>
			<footer class="f">
				<?php if(!a($bank, 'mellat', 'empty')) {?>
					<div class="cauto"><div class="linkDel btn" data-confirm data-data='{"set_mellat": 1, "delete" : "delete"}'><?php echo T_("Remove") ?></div></div>
				<?php } //endif ?>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Save") ?></button></div>

			</footer>
		</div>
	</div>
</form>