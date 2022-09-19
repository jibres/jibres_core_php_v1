<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-xs-12 c-sm-12 c-lg-8">
		<?php require_once(root . 'content_a/form/formTitle.php'); ?>
        <div class="avand-md">

            <form method="post" autocomplete="off" id="form1">
                <div class="box">
                    <div class="pad">
						<?php
						$myKey = a(\dash\data::itemDetail(), 'id');
						$value = \dash\data::itemDetail();
						?>
                        <label><?php echo T_("Item title") ?></label>
                        <div class="input">
                            <input type="text" name="item_title_<?php echo $myKey ?>"
                                   placeholder="<?php echo T_("Title") ?>" value="<?php echo a($value, 'title'); ?>">
                        </div>

                        <div class="alert2">
                            <div class="f">
                                <div class="c s12">
                                    <small><?php echo T_("Item type") ?></small>
                                    <b><?php echo a($value, 'type_detail', 'title'); ?></b>
                                </div>
                                <div class="cauto s12">
                                    <a class="btn-link"
                                       href="<?php echo \dash\url::this() . '/item/type?' . \dash\request::fix_get() ?>"><?php echo T_("Change type") ?></a>
                                </div>
                            </div>

                        </div>

						<?php if(a(\dash\data::itemDetail(), 'type_detail', 'require') === false) {/*nothing*/
						} else { ?>
                            <div class="mt-2">
                                <input type="hidden" name="item_checkrequire_<?php echo $myKey ?>" value="1">
                                <div class="switch1">
                                    <input type="checkbox" name="item_require_<?php echo $myKey ?>"
                                           id="check1hidden<?php echo $myKey; ?>" <?php if(a($value, 'require')) {
										echo 'checked';
									} ?>>
                                    <label for="check1hidden<?php echo $myKey; ?>"><?php echo T_("Is required?"); ?></label>
                                    <label for="check1hidden<?php echo $myKey; ?>"><?php echo T_("Is required?"); ?></label>
                                </div>
                            </div>
						<?php } //endif ?>

						<?php settingRecord(\dash\data::itemDetail()); ?>


						<?php if(a(\dash\data::itemDetail(), 'type_detail', 'hiddenable') === false) {/*nothing*/
						} else { ?>
                            <div class="mt-2">
                                <input type="hidden" name="item_checkhidden_<?php echo $myKey ?>" value="1">
                                <div class="switch1">
                                    <input type="checkbox" name="item_hidden_<?php echo $myKey ?>"
                                           id="check1<?php echo $myKey; ?>" <?php if(a($value, 'hidden')) {
										echo 'checked';
									} ?>>
                                    <label for="check1<?php echo $myKey; ?>"><?php echo T_("Hidden"); ?></label>
                                    <label for="check1<?php echo $myKey; ?>"><?php echo T_("Hidden"); ?>
                                        <small><?php echo T_("Only you can view this item and edit answer") ?></small></label>
                                </div>
                            </div>
						<?php } //ednif ?>

                    </div>
                    <footer class="f">

                        <div class="cauto">
                            <div class="btn-link-danger" data-confirm
                                 data-data='{"removeitem": "removeitem"}'><?php echo T_("Remove question") ?></div>
                        </div>
                        <div class="c"></div>
                        <div class="cauto">
                            <button class="btn-success" type="submit"><?php echo T_("Save"); ?></button>
                        </div>


                    </footer>
                </div>

            </form>
        </div>
    </div>
</div>
	<?php


	function settingRecord($value)
	{
		if(!isset($value['type_detail']))
		{
			return;
		}

		if(a(\dash\data::itemDetail(), 'type_detail', 'description') === false)
		{
			/*nothing*/
		}
		else
		{
			settingDesc($value);
		}

		if(isset($value['type_detail']['placeholder']) && $value['type_detail']['placeholder'])
		{
			settingPlaceHolder($value);
		}

		if(isset($value['type_detail']['coefficient']) && $value['type_detail']['coefficient'])
		{
			settingCoefficient($value);
		}


		if(isset($value['type_detail']['maxlen']) && $value['type_detail']['maxlen'])
		{
			settingMaxLen($value);

		}


		if(isset($value['type_detail']['urlkey']) && $value['type_detail']['urlkey'])
		{
			settinguUrlkey($value);
		}

		if(isset($value['type_detail']['whitelist']) && $value['type_detail']['whitelist'])
		{
			settinguWhitelist($value);
		}


		if(isset($value['type_detail']['min']) && $value['type_detail']['min'])
		{
			settingMin($value);
		}

		if(isset($value['type_detail']['max']) && $value['type_detail']['max'])
		{
			settingMax($value);
		}

		if(isset($value['type_detail']['length']) && $value['type_detail']['length'])
		{
			settingLength($value);
		}




		if(isset($value['type_detail']['mindate']) && $value['type_detail']['mindate'])
		{
			settingMindate($value);
		}

		if(isset($value['type_detail']['maxdate']) && $value['type_detail']['maxdate'])
		{
			settingMaxdate($value);
		}


		if(isset($value['type_detail']['choiceinline']) && $value['type_detail']['choiceinline'])
		{
			settingChoiceInline($value);
		}


		if(isset($value['type_detail']['random']) && $value['type_detail']['random'])
		{
			settingRandom($value);
		}


		if(isset($value['type_detail']['check_unique']) && $value['type_detail']['check_unique'])
		{
			settingCheckUnique($value);
		}

		if(isset($value['type_detail']['filetype']) && $value['type_detail']['filetype'])
		{
			settingFileType($value);
		}

		if(isset($value['type_detail']['color']) && $value['type_detail']['color'])
		{
			settingColor($value);
		}

		if(isset($value['type_detail']['send_sms']) && $value['type_detail']['send_sms'])
		{
			settingSendSms($value);
		}


		if(isset($value['type_detail']['signup']) && $value['type_detail']['signup'])
		{
			settingSignup($value);
		}

		if(isset($value['type_detail']['defaultvalue']) && $value['type_detail']['defaultvalue'])
		{
			settingDefaultvalue($value);
		}

		if(isset($value['type_detail']['link']) && $value['type_detail']['link'])
		{
			settingLink($value);
		}


		if(isset($value['type_detail']['choice']) && $value['type_detail']['choice'])
		{
			settingChoice($value);
		}

		if(isset($value['type_detail']['lowercase']) && $value['type_detail']['lowercase'])
		{
			settingLovercase($value);
		}


		if(isset($value['type_detail']['uppercase']) && $value['type_detail']['uppercase'])
		{
			settingUppercase($value);
		}


	}

	function settingDesc($value)
	{ ?>
        <label class="" for="item_desc_<?php echo a($value, 'id') ?>"><?php echo T_("Description") ?></label>
        <textarea class="txt mb-4" rows="2" name="item_desc_<?php echo a($value, 'id') ?>"
                  id="item_desc_<?php echo a($value, 'id') ?>"><?php echo a($value, 'desc'); ?></textarea>

	<?php } //endif
	function settingMaxLen($value)
	{ ?>
        <label for="item_maxlen_<?php echo a($value, 'id') ?>"><?php echo T_("Maximum len") ?></label>
        <div class="input">
            <input type="tel" name="item_maxlen_<?php echo a($value, 'id') ?>"
                   id="item_maxlen_<?php echo a($value, 'id') ?>" value="<?php echo a($value, 'maxlen'); ?>">
        </div>
	<?php } //endif


    function settingCoefficient($value)
	{ ?>
        <label for="item_length_<?php echo a($value, 'id') ?>"><?php echo T_("Coefficient") ?></label>
        <div class="input">
            <input type="tel" name="item_coefficient_<?php echo a($value, 'id') ?>"
                   id="item_coefficient_<?php echo a($value, 'id') ?>"
                   value="<?php echo a($value, 'setting', a($value, 'type'), 'coefficient'); ?>" data-format="price">
            <label class="addon" for="item_coefficient_<?php echo a($value, 'id') ?>"><?php echo \lib\store::currency() ?></label>
        </div>
	<?php } //endif

	function settingLength($value)
	{ ?>
        <label for="item_length_<?php echo a($value, 'id') ?>"><?php echo T_("Length") ?></label>
        <div class="input">
            <input type="tel" name="item_length_<?php echo a($value, 'id') ?>"
                   id="item_length_<?php echo a($value, 'id') ?>"
                   value="<?php echo a($value, 'setting', a($value, 'type'), 'length'); ?>">
        </div>
	<?php } //endif

	function settingLovercase($value)
	{ ?>
        <div class="switch1">
            <input type="checkbox" name="item_lowercase_<?php echo a($value, 'id') ?>"
                   id="item_lowercase_<?php echo a($value, 'id'); ?>" <?php if(a($value, 'setting', a($value, 'type'), 'lowercase')) {
				echo 'checked';
			} ?>>
            <label for="item_lowercase_<?php echo a($value, 'id'); ?>"><?php echo T_("Include lowercase"); ?></label>
            <label for="item_lowercase_<?php echo a($value, 'id'); ?>"><?php echo T_("Include lowercase"); ?></label>
        </div>

	<?php } //endif


	function settingUppercase($value)
	{ ?>
        <div class="switch1">
            <input type="checkbox" name="item_uppercase_<?php echo a($value, 'id') ?>"
                   id="item_uppercase_<?php echo a($value, 'id'); ?>" <?php if(a($value, 'setting', a($value, 'type'), 'uppercase')) {
				echo 'checked';
			} ?>>
            <label for="item_uppercase_<?php echo a($value, 'id'); ?>"><?php echo T_("Include uppercase"); ?></label>
            <label for="item_uppercase_<?php echo a($value, 'id'); ?>"><?php echo T_("Include uppercase"); ?></label>
        </div>

	<?php } //endif


	function settingMin($value)
	{ ?>
        <label for="item_min_<?php echo a($value, 'id') ?>"><?php echo T_("Minimum") ?></label>
        <div class="input">
            <input type="tel" name="item_min_<?php echo a($value, 'id') ?>" id="item_min_<?php echo a($value, 'id') ?>"
                   value="<?php echo a($value, 'setting', a($value, 'type'), 'min'); ?>">
        </div>
	<?php } //endif


	function settingMindate($value)
	{ ?>
        <label for="item_mindate_<?php echo a($value, 'id') ?>"><?php echo T_("Minimum date") ?></label>
        <div class="input">
            <input type="tel" name="item_mindate_<?php echo a($value, 'id') ?>"
                   id="item_mindate_<?php echo a($value, 'id') ?>"
                   value="<?php echo a($value, 'setting', a($value, 'type'), 'mindate'); ?>" data-format='date'>
        </div>
	<?php } //endif


	function settingMaxdate($value)
	{ ?>
        <label for="item_maxdate_<?php echo a($value, 'id') ?>"><?php echo T_("Maximum date") ?></label>
        <div class="input">
            <input type="tel" name="item_maxdate_<?php echo a($value, 'id') ?>"
                   id="item_maxdate_<?php echo a($value, 'id') ?>"
                   value="<?php echo a($value, 'setting', a($value, 'type'), 'maxdate'); ?>" data-format='date'>
        </div>
	<?php } //endif


	function settingMax($value)
	{ ?>
        <label for="item_max_<?php echo a($value, 'id') ?>"><?php echo T_("Maximum") ?></label>
        <div class="input">
            <input type="tel" name="item_max_<?php echo a($value, 'id') ?>" id="item_max_<?php echo a($value, 'id') ?>"
                   value="<?php echo a($value, 'setting', a($value, 'type'), 'max'); ?>">
        </div>
	<?php } //endif


	function settingPlaceHolder($value)
	{ ?>
        <label for="item_placeholder_<?php echo a($value, 'id') ?>"><?php echo T_("Placeholder") ?></label>
        <div class="input">
            <input type="text" name="item_placeholder_<?php echo a($value, 'id') ?>"
                   id="item_placeholder_<?php echo a($value, 'id') ?>"
                   value="<?php echo a($value, 'setting', a($value, 'type'), 'placeholder'); ?>">
        </div>
	<?php } //endif


	function settingChoiceInline($value)
	{ ?>
        <div class="check1 mt-6">
            <input type="checkbox" name="item_choiceinline_<?php echo a($value, 'id') ?>"
                   id="checkinline<?php echo a($value, 'id'); ?>" <?php if(a($value, 'setting', a($value, 'type'), 'choiceinline')) {
				echo 'checked';
			} ?>>
            <label for="checkinline<?php echo a($value, 'id'); ?>"><?php echo T_("Put every choice in one line"); ?></label>
        </div>
	<?php } // endfunction


	function settingRandom($value)
	{ ?>
        <div class="check1 mt-6">
            <input type="checkbox" name="item_random_<?php echo a($value, 'id') ?>"
                   id="checkrandom<?php echo a($value, 'id'); ?>" <?php if(a($value, 'setting', a($value, 'type'), 'random')) {
				echo 'checked';
			} ?>>
            <label for="checkrandom<?php echo a($value, 'id'); ?>"><?php echo T_("Random choice"); ?></label>
        </div>
	<?php } // endfunction


	function settingCheckUnique($value)
	{ ?>
        <div class="check1 mt-6">
            <input type="checkbox" name="item_check_unique_<?php echo a($value, 'id') ?>"
                   id="checkunique<?php echo a($value, 'id'); ?>" <?php if(a($value, 'setting', a($value, 'type'), 'check_unique')) {
				echo 'checked';
			} ?>>
            <label for="checkunique<?php echo a($value, 'id'); ?>"><?php echo T_("Check unique"); ?></label>
        </div>
        <div data-response='item_check_unique_<?php echo a($value, 'id') ?>' <?php if(a($value, 'setting', a($value, 'type'), 'check_unique')) {/*nothing*/
		} else {
			echo 'data-response-hide';
		} ?>>
            <small class="text-gray-400"><?php echo T_('In addition to checking the non-duplication of this item in the list of previous answers, you can manually enter the list of items that you think are duplicate so that they are not registered.') ?></small>
            <a class="btn-link"
               href="<?php echo \dash\url::that() . '/duplicatelist' . \dash\request::full_get(['q' => null]) ?>"><?php echo T_("Define duplicate list") ?></a>
        </div>
	<?php } // endfunction


	function settingFileType($value)
	{
		$saved_filetype = a($value, 'setting', a($value, 'type'), 'filetype');
		if(!is_array($saved_filetype))
		{
			$saved_filetype = [];
		}
		?>
        <label for="item_filetype_<?php echo a($value, 'id') ?>"><?php echo T_("Allow extention file"); ?></label>
        <div>
            <select class="select22" name="item_filetype_<?php echo a($value, 'id') ?>[]" multiple="multiple">
                <option value=""><?php echo T_("Any file"); ?></option>
				<?php foreach (\dash\data::allAllowFileExt() as $key => $value) { ?>
                    <option value="<?php echo $key ?>" <?php if(in_array($key, $saved_filetype)) {
						echo 'selected';
					} ?>><?php echo $key; ?></option>
				<?php } //endfor ?>
            </select>
        </div>
	<?php } // endfunction


	function settingSendSms($value)
	{ ?>
        <div class="check1 mt-6">
            <input type="checkbox" name="item_send_sms_<?php echo a($value, 'id') ?>"
                   id="send_sms<?php echo a($value, 'id'); ?>" <?php if(a($value, 'setting', a($value, 'type'), 'send_sms')) {
				echo 'checked';
			} ?>>
            <label for="send_sms<?php echo a($value, 'id'); ?>"><?php echo T_("Send notification after complete form?"); ?></label>
        </div>
        <div data-response="item_send_sms_<?php echo a($value, 'id') ?>" <?php if(a($value, 'setting', a($value, 'type'), 'send_sms')) {
		} else {
			echo 'data-response-hide';
		} ?>>
            <label for="item_sms_text_<?php echo a($value, 'id') ?>"><?php echo T_("Notification text") ?></label>
            <textarea class="txt" rows="2" name="item_sms_text_<?php echo a($value, 'id') ?>"
                      id="item_sms_text_<?php echo a($value, 'id') ?>"><?php echo a($value, 'setting', a($value, 'type'), 'sms_text'); ?></textarea>
        </div>
	<?php } // endfunction


	function settingSignup($value)
	{ ?>
        <div class="check1 mt-6">
            <input type="checkbox" name="item_signup_<?php echo a($value, 'id') ?>"
                   id="signup<?php echo a($value, 'id'); ?>" <?php if(a($value, 'setting', a($value, 'type'), 'signup')) {
				echo 'checked';
			} ?>>
            <label for="signup<?php echo a($value, 'id'); ?>"><?php echo T_("Signup user by this item?"); ?></label>
        </div>
	<?php } // endfunction


	function settingDefaultvalue($value)
	{ ?>

        <label for="item_defaultvalue_<?php echo a($value, 'id') ?>"><?php echo T_("Default value") ?></label>
        <div class="input">
            <input type="text" name="item_defaultvalue_<?php echo a($value, 'id') ?>"
                   id="item_defaultvalue_<?php echo a($value, 'id') ?>"
                   value="<?php echo a($value, 'setting', a($value, 'type'), 'defaultvalue'); ?>">
        </div>
	<?php } // endfunction


	function settinguWhitelist($value)
	{
		$current_value = a($value, 'setting', a($value, 'type'), 'whitelist');
		if(!is_array($current_value))
		{
			$current_value = [];
		}

		?>
        <label for="item_whitelist_<?php echo a($value, 'id') ?>"><?php echo T_("White list value"); ?></label>
        <div>
            <select class="select22" name="item_whitelist_<?php echo a($value, 'id') ?>[]" multiple="multiple"
                    data-model='tag'>
				<?php foreach ($current_value as $key => $value) { ?>
                    <option value="<?php echo $value ?>" selected><?php echo $value; ?></option>
				<?php } //endfor ?>
            </select>
        </div>
	<?php } // endfunction


	function settinguUrlkey($value)
	{ ?>

        <label for="item_urlkey_<?php echo a($value, 'id') ?>"><?php echo T_("Define url key") ?></label>
        <div class="input ltr">
            <input type="text" name="item_urlkey_<?php echo a($value, 'id') ?>"
                   id="item_urlkey_<?php echo a($value, 'id') ?>"
                   value="<?php echo a($value, 'setting', a($value, 'type'), 'urlkey'); ?>">
        </div>

		<?php
		if(!a($value, 'setting', a($value, 'type'), 'urlkey'))
		{
			echo '<div class="alert-danger">' . T_("To use from this item you need to define the url key") . '</div>';
		}
		else
		{
			echo '<div class="alert-info">';
			{
				echo T_("The form url by this index");

				echo '<br>';

				echo '<small>' . T_("Replace :val to your value", ['val' => '[YOURVALUE]']) . '</small>';

				$theurlkey =
					\dash\data::dataRow_urlraw() . '?' . a($value, 'setting', a($value, 'type'), 'urlkey') . '=[YOURVALUE]';
				echo '<div class="ltr">';
				{
					echo '<a class="ltr text-left font-bold" data-copy="' . $theurlkey . '" >';
					echo $theurlkey;
					echo '</a>';
				}
				echo '</div>';

			}
			echo '</div>';

		}


	} // endfunction


	function settingColor($value)
	{ ?>
        <label for="item_color_<?php echo a($value, 'id') ?>"><?php echo T_("Message Type"); ?></label>
        <div>
            <select class="select22" name="item_color_<?php echo a($value, 'id') ?>">
                <option value=""><?php echo T_("Default"); ?></option>
                <option value="red" <?php if(a($value, 'setting', a($value, 'type'), 'color') === 'red') {
					echo 'selected';
				} ?>><?php echo T_("Red (For important warning message)") ?></option>
                <option value="green" <?php if(a($value, 'setting', a($value, 'type'), 'color') === 'green') {
					echo 'selected';
				} ?>><?php echo T_("Green (For thank you message)") ?></option>
                <option value="blue" <?php if(a($value, 'setting', a($value, 'type'), 'color') === 'blue') {
					echo 'selected';
				} ?>><?php echo T_("Blue (For information message)") ?></option>
                <option value="yellow" <?php if(a($value, 'setting', a($value, 'type'), 'color') === 'yellow') {
					echo 'selected';
				} ?>><?php echo T_("Yellow (For warning message)") ?></option>
            </select>
        </div>

	<?php } // endfunction


	function settingLink($value)
	{ ?>
        <label for="item_link_<?php echo a($value, 'id') ?>"><?php echo T_("Link"); ?></label>
        <div class="input">
            <input type="text" name="item_link_<?php echo a($value, 'id') ?>"
                   id="item_link_<?php echo a($value, 'id') ?>"
                   value="<?php echo a($value, 'setting', a($value, 'type'), 'link'); ?>">
        </div>
        <div class="check1 mt-6">
            <input type="checkbox" name="item_targetblank_<?php echo a($value, 'id') ?>"
                   id="targetblank<?php echo a($value, 'id'); ?>" <?php if(a($value, 'setting', a($value, 'type'), 'targetblank')) {
				echo 'checked';
			} ?>>
            <label for="targetblank<?php echo a($value, 'id'); ?>"><?php echo T_("Open in blank page?"); ?></label>
        </div>
	<?php } // endfunction


	function settingChoice($value)
	{ ?>
    <div class="alert2 mt-4">
        <div class="f">
            <div class="c s12">
				<?php echo T_("Choices") ?>
            </div>
            <div class="cauto s12">
                <a class="btn-link"
                   href="<?php echo \dash\url::this() . '/item/choice?' . \dash\request::fix_get() ?>"><?php echo T_("Manage choice") ?></a>
            </div>
        </div>
    </div>

	<?php if(\dash\data::choiceList()) { ?>

        <div class="tblBox font-14">
            <table class="tbl1 v4">
                <tbody>
				<?php foreach (\dash\data::choiceList() as $key => $value) { ?>
                    <tr>
                        <td class="collapsing"><?php echo \dash\fit::number($key + 1) ?></td>
                        <td><?php echo a($value, 'title') ?></td>

                        <td>
							<?php if(a($value, 'price'))
							{
								echo \dash\fit::number(a($value, 'price')) . ' ' . \lib\store::currency();
							}
							?>


                        </td>
                    </tr>
				<?php } //endfor ?>
                </tbody>
            </table>
        </div>
        </form>
	<?php } //endif ?>

<?php } // endfunction ?>