


<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">

			<form method="post" autocomplete="off">

				<div class="msg txtL txtB"><?php echo \dash\data::dataRow_nic_id(); ?></div>
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

				<?php if(\dash\data::dataRow_firstname_en()) { echo '<h4>'. T_("Holder information"). '</h4>'; }?>
				<ul class="ltr">

					<?php
					 if(\dash\data::dataRow_firstname_en()) 	{ echo '<li>'. 'Firstname '		. '<b>' .  \dash\data::dataRow_firstname_en() 	. '</b></li>'; }
					 if(\dash\data::dataRow_lastname_en()) 		{ echo '<li>'. 'Lastname '		. '<b>' .  \dash\data::dataRow_lastname_en() 	. '</b></li>'; }
					 if(\dash\data::dataRow_nationalcode()) 	{ echo '<li>'. 'Nationalcode '	. '<b>' .  \dash\data::dataRow_nationalcode() 	. '</b></li>'; }
					 if(\dash\data::dataRow_email()) 			{ echo '<li>'. 'Email '			. '<b>' .  \dash\data::dataRow_email() 			. '</b></li>'; }
					 if(\dash\data::dataRow_country()) 			{ echo '<li>'. 'Country '		. '<b>' .  \dash\data::dataRow_country() 		. '</b></li>'; }
					 if(\dash\data::dataRow_province()) 		{ echo '<li>'. 'Province '		. '<b>' .  \dash\data::dataRow_province() 		. '</b></li>'; }
					 if(\dash\data::dataRow_city()) 			{ echo '<li>'. 'City '			. '<b>' .  \dash\data::dataRow_city() 			. '</b></li>'; }
					 if(\dash\data::dataRow_postcode()) 		{ echo '<li>'. 'Postcode '		. '<b>' .  \dash\data::dataRow_postcode() 		. '</b></li>'; }
					 if(\dash\data::dataRow_address()) 			{ echo '<li>'. 'Address '		. '<b>' .  \dash\data::dataRow_address() 		. '</b></li>'; }
					?>

				</ul>


				<div class="f mT20">
					<div class="c">
						<div class="ibtn wide">
							<?php echo '<span>'.T_("Holder"). '</span>'; if(\dash\data::dataRow_holder()) { echo '<i class="sf-check fc-green"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?>
						</div>
					</div>
					<div class="c">
						<div class="ibtn wide">
							<?php echo '<span>'.T_("Admin"). '</span>'; if(\dash\data::dataRow_admin()) { echo '<i class="sf-check fc-green"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?>
						</div>
					</div>
					<div class="c">
						<div class="ibtn wide">
							<?php echo '<span>'.T_("Technical"). '</span>'; if(\dash\data::dataRow_tech()) { echo '<i class="sf-check fc-green"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?>
						</div>
					</div>
					<div class="c">
						<div class="ibtn wide">
							<?php echo '<span>'.T_("billing"). '</span>'; if(\dash\data::dataRow_bill()) { echo '<i class="sf-check fc-green"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?>
						</div>
					</div>

				</div>


				<p class="mT20">
					<?php echo T_("If you update your contact detail in nic.ir website") ?>
					<br>
					<?php echo T_("You can Check data from IRNIC server and update contact"); ?>
				</p>

				<?php if(\dash\data::dataRow_datemodified()) {?>

				<p>
					<?php echo T_("Last checked"); ?> <b><?php echo \dash\fit::date_human(\dash\data::dataRow_datemodified()); ?></b>
				</p>

				<?php } //endif ?>


				<div class="txtRa">
					<button class="btn secondary"><?php echo T_("Check"); ?></button>
				</div>

			</form>

		</div>


		<div class="cbox">
			<p>
				<?php echo T_("You can remove this contanc if don't need") ?>
			</p>

			<div class="txtRa">
				<button data-confirm data-data='{"myaction": "remove"}' class="btn danger"><?php echo T_("Remove"); ?></button>
			</div>
		</div>


	</div>
</div>
