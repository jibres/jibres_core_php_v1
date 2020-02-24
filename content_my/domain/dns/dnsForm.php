<div class="cbox">
			<form method="post" autocomplete="off">
				<label for="title"><?php echo T_("Title"); ?></label>
				<div class="input">
					<input type="text" name="title" id="title" value="<?php echo \dash\data::dataRow_title(); ?>" maxlength="99">
				</div>


			    <div class="f">


			    	<div class="c6 s12">
					    <label for="ns1"><?php echo T_("DNS #1"); ?></label>
						<div class="input ltr">
							<input type="text" name="ns1" id="ns1" maxlength="50" value="<?php echo \dash\data::dataRow_ns1(); ?>" <?php if(\dash\data::dataRow_count_useage()) { echo 'disabled'; } ?>>
						</div>
						<label for="ns2"><?php echo T_("DNS #2"); ?></label>
						<div class="input ltr">
							<input type="text" name="ns2" id="ns2" maxlength="50" value="<?php echo \dash\data::dataRow_ns2(); ?>" <?php if(\dash\data::dataRow_count_useage()) { echo 'disabled'; } ?>>
						</div>
			    	</div>

			    	<div class="c6 s12">
			    		<div class="mLa5">
							<label for="ip1"><?php echo T_("IP #1"); ?></label>
							<div class="input ltr">
								<input type="text" name="ip1" id="ip1" maxlength="50" value="<?php echo \dash\data::dataRow_ip1(); ?>" <?php if(\dash\data::dataRow_count_useage()) { echo 'disabled'; } ?>>
							</div>
							<label for="ip2"><?php echo T_("IP #2"); ?></label>
							<div class="input ltr">
								<input type="text" name="ip2" id="ip2" maxlength="50" value="<?php echo \dash\data::dataRow_ip2(); ?>" <?php if(\dash\data::dataRow_count_useage()) { echo 'disabled'; } ?>>
							</div>
			    		</div>
			    	</div>

			    	<div class="c6 s12">
						<label for="ns3"><?php echo T_("DNS #3"); ?></label>
						<div class="input ltr">
							<input type="text" name="ns3" id="ns3" maxlength="50" value="<?php echo \dash\data::dataRow_ns3(); ?>" <?php if(\dash\data::dataRow_count_useage()) { echo 'disabled'; } ?>>
						</div>
						<label for="ns4"><?php echo T_("DNS #4"); ?></label>
						<div class="input ltr">
							<input type="text" name="ns4" id="ns4" maxlength="50" value="<?php echo \dash\data::dataRow_ns4(); ?>" <?php if(\dash\data::dataRow_count_useage()) { echo 'disabled'; } ?>>
						</div>
			    	</div>

			    	<div class="c6 s12">
			    		<div class="mLa5">
							<label for="ip3"><?php echo T_("IP #3"); ?></label>
							<div class="input ltr">
								<input type="text" name="ip3" id="ip3" maxlength="50" value="<?php echo \dash\data::dataRow_ip3(); ?>" <?php if(\dash\data::dataRow_count_useage()) { echo 'disabled'; } ?>>
							</div>

							<label for="ip4"><?php echo T_("IP #4"); ?></label>
							<div class="input ltr">
								<input type="text" name="ip4" id="ip4" maxlength="50" value="<?php echo \dash\data::dataRow_ip4(); ?>" <?php if(\dash\data::dataRow_count_useage()) { echo 'disabled'; } ?>>
							</div>
			    		</div>
			    	</div>
			    </div>

			    <div class="switch1">
	              <input type="checkbox" name="isdefault" id="isdefault" <?php if(\dash\data::dataRow_isdefault()) { echo "checked";} ?>>
	              <label for="isdefault" data-on='<?php echo T_("Yes"); ?>' data-off='<?php echo T_("No"); ?>'></label>
	              <label for="isdefault"><?php echo T_("Is default?"); ?></label>
	            </div>

				<div class="txtRa">
					<?php if(\dash\url::child()) {?>

						<button class="btn info"><?php echo T_("Add DNS record"); ?></button>

		            <?php }else{ ?>

		            	<?php if(\dash\data::dataRow_count_useage()) {?>
		            		<div class="msg warn2"><?php echo T_("This dns useage in some domain."); ?> <?php echo T_("Namesever and ip of this record can not be update"); ?></div>
						<?php } // endif ?>

						<button class="btn primary"><?php echo T_("Edit DNS record"); ?></button>

		            <?php } //endif ?>
				</div>
			</form>
		</div>