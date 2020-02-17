


<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">

			<form method="post" autocomplete="off">

				<div class="msg info2 txtB txtC"><?php echo \dash\data::dataRow_nic_id(); ?></div>
				<label for="ititle"><?php echo T_("Title"); ?></label>
				<div class="input">
					<input type="text" name="title" id="ititle" value="<?php echo \dash\data::dataRow_title(); ?>" maxlength="50">
				</div>

				<div class="switch1">
	              <input type="checkbox" name="isdefault" id="isdefault" <?php if(\dash\data::dataRow_isdefault()) { echo 'checked'; } ?>>
	              <label for="isdefault" data-on='<?php echo T_("Yes"); ?>' data-off='<?php echo T_("No"); ?>'></label>
	              <label for="isdefault"><?php echo T_("Is default?"); ?></label>
	            </div>

				<div class="txtRa">
					<button class="btn info"><?php echo T_("Edit"); ?></button>
				</div>
			</form>

		</div>


		<div class="cbox">

			<form method="post" autocomplete="off">

				<input type="hidden" name="check" value="again">

				<div class="msg sm"><?php echo T_("Holder"); if(\dash\data::dataRow_holder()) {?> <i class="sf-check fc-green"></i> <?php }else{ ?> <i class="sf-times fc-red"></i> <?php } // endif ?></div>
				<div class="msg sm"><?php echo T_("Admin"); if(\dash\data::dataRow_admin()) {?> <i class="sf-check fc-green"></i> <?php }else{ ?> <i class="sf-times fc-red"></i> <?php } // endif ?></div>
				<div class="msg sm"><?php echo T_("Technical"); if(\dash\data::dataRow_tech()) {?> <i class="sf-check fc-green"></i> <?php }else{ ?> <i class="sf-times fc-red"></i> <?php } // endif ?></div>
				<div class="msg sm"><?php echo T_("billing"); if(\dash\data::dataRow_bill()) {?> <i class="sf-check fc-green"></i> <?php }else{ ?> <i class="sf-times fc-red"></i> <?php } // endif ?></div>

				<p>
					<?php echo T_("Check data from IRNIC server and update contact"); ?>
				</p>

				<?php if(\dash\data::dataRow_datemodified()) {?>

				<p>
					<?php echo T_("Last checked"); ?> <?php echo \dash\data::dataRow_datemodified(); ?>
				</p>

				<?php } //endif ?>


				<div class="txtRa">
					<button class="btn secondary"><?php echo T_("Go"); ?></button>
				</div>

			</form>

		</div>


		<div class="cbox">
			<p>
				<?php echo T_("Remove contact"); ?>
			</p>

			<div class="txtRa">
				<button data-confirm data-data='{"myaction": "remove"}' class="btn danger"><?php echo T_("Remove"); ?></button>
			</div>
		</div>


	</div>
</div>
