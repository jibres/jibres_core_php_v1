<?php $inquerySetting = \dash\data::dataRow_resultpagesetting() ?>
<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-xs-12 c-sm-12 c-lg-8">
        <form method="post" autocomplete="off" id="form1">
            <div class="box">
                <div class="pad">
                    <p><?php echo T_("By activating this feature, the customer can see a list of registered responses to this form.") ?></p>
                    <div class="switch1 mb-4 mt-4">
                        <input type="checkbox" name="resultpage"
                               id="resultpage" <?php if (a(\dash\data::dataRow_resultpagesetting(), 'status')) {
							echo 'checked';
						} ?>>
                        <label for="resultpage"></label>
                        <label for="resultage"><?php echo T_("Enable result page") ?></label>
                    </div>

                    <div data-response="resultpage" <?php if (a(\dash\data::dataRow_resultpagesetting(), 'status')) {/*nothing*/
					} else {
						echo 'data-response-hide';
					} ?>>

                            <span><?php echo T_("Result page address") ?></span>
                            <div class="alert-secondary ltr text-left f">
                                <div class="text-left ltr"><a target="_blank"
                                                              href="<?php echo \dash\data::dataRow_url() . '/result'; ?>"><?php echo \dash\data::dataRow_url() . '/result'; ?></a>
                                </div>
                                <div class="text-right"
                                     data-copy="<?php echo \dash\data::dataRow_url() . '/result'; ?>"><?php echo \dash\utility\icon::svg('link') ?></div>
                            </div>


                        <?php if (!\dash\data::formItems()) { ?>
                            <div class="alert-warning"><?php echo T_("You have not any question in your form.") ?></div>
						<?php } else { ?>
                            <p class="mB0-f"><?php echo T_("Which question display in result page?") ?></p>
							<?php foreach (\dash\data::formItems() as $key => $value) {
								$myId = a($value, 'id'); ?>

                                <div class="check1">
                                    <input type="checkbox" name="question[]" value="<?php echo a($value, 'id') ?>"
                                           id="<?php echo $myId ?>" <?php if (is_array(a($inquerySetting, 'question')) && in_array($myId, $inquerySetting['question'])) {
										echo 'checked';
									} ?>>

                                    <label for="<?php echo $myId ?>">
                                       <span class="text-gray-500"> ( <?php echo a($value, 'type_detail', 'title');  ?> )</span>
                                        <?php echo a($value, 'title') ?>
                                    </label>
                                </div>

							<?php } //endif ?>
						<?php } //endif ?>


                        <div class="mb-2">
                            <label for="resultpagetext"><?php echo T_("Result page Message") ?></label>
                            <textarea name="resultpagetext" class="txt" rows="3" id="resultagemsg"
                                      placeholder="<?php echo T_("Result page Message") ?>"><?php echo \dash\data::dataRow_resultpagetext(); ?></textarea>
                        </div>


                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
