<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-xs-12 c-sm-12 c-lg-8">

        <form method="post" autocomplete="off" id='form1'>
            <div class="avand-md">

                <section class="box">
                    <div class="body">
                        <label for="itagname"><?php echo T_("Title"); ?></label>
                        <div class="input">
                            <input type="text" name="title" id="itagname" placeholder='<?php echo T_("Tag name"); ?>'
                                   value="<?php echo \dash\data::dataRow_title(); ?>" <?php \dash\layout\autofocus::html() ?>
                                   maxlength='50' minlength="1" required>
                        </div>

                        <div class="mb-2">
                            <label for="desc"><?php echo T_("Description") ?>
                                <small><?php echo T_("This message will be displayed on the Inquiry page for answers that have this tag") ?></small></label>
                            <textarea name="desc" class="txt" rows="3" id="desc"
                                      placeholder="<?php echo T_("Inquiry Message") ?>"><?php echo \dash\data::dataRow_desc(); ?></textarea>
                        </div>

                    </div>

                </section>

                <div class="box">
                    <div class="pad">

                        <div class="check1">
                            <input type="checkbox" name="isdefault"
                                   id="isdefault" <?php if(\dash\data::dataRow_isdefault())
							{
								echo 'checked';
							} ?>>
                            <label for="isdefault"><?php echo T_("Add this tag by default to all new answer") ?></label>
                        </div>

                        <label class=""><?php echo T_("Privacy") ?></label>
                        <div class="row mb-2">
                            <div class="c-xs-6 c-sm-6">
                                <div class="radio3">
                                    <input type="radio" name="privacy"
                                           value="public" <?php if(\dash\data::dataRow_privacy() === 'public')
									{
										echo 'checked';
									} ?> id="privacypublic">
                                    <label for="privacypublic"><?php echo T_("Public") ?></label>
                                </div>
                            </div>
                            <div class="c-xs-6 c-sm-6">
                                <div class="radio3">
                                    <input type="radio" name="privacy"
                                           value="private" <?php if(\dash\data::dataRow_privacy() === 'private')
									{
										echo 'checked';
									} ?> id="privacyprivate">
                                    <label for="privacyprivate"><?php echo T_("Private") ?></label>
                                </div>
                            </div>
                        </div>

                        <label class=""><?php echo T_("Color") ?></label>
                        <div class="row mb-4">
                            <div class="c-xs-6 c-sm-3">
                                <div class="radio3">
                                    <input type="radio" name="color"
                                           value="red" <?php if(\dash\data::dataRow_color() === 'red')
									{
										echo 'checked';
									} ?> id="colorred">
                                    <label for="colorred"><?php echo T_("Red") ?></label>
                                </div>
                            </div>
                            <div class="c-xs-6 c-sm-3">
                                <div class="radio3">
                                    <input type="radio" name="color"
                                           value="green" <?php if(\dash\data::dataRow_color() === 'green')
									{
										echo 'checked';
									} ?> id="colorgreen">
                                    <label for="colorgreen"><?php echo T_("Green") ?></label>
                                </div>
                            </div>

                            <div class="c-xs-6 c-sm-3">
                                <div class="radio3">
                                    <input type="radio" name="color"
                                           value="blue" <?php if(\dash\data::dataRow_color() === 'blue')
									{
										echo 'checked';
									} ?> id="colorblue">
                                    <label for="colorblue"><?php echo T_("Blue") ?></label>
                                </div>
                            </div>

                            <div class="c-xs-6 c-sm-3">
                                <div class="radio3">
                                    <input type="radio" name="color"
                                           value="black" <?php if(\dash\data::dataRow_color() === 'black')
									{
										echo 'checked';
									} ?> id="colorblack">
                                    <label for="colorblack"><?php echo T_("Black") ?></label>
                                </div>
                            </div>

                        </div>


                        <div class="check1">
                            <input type="checkbox" name="autocomment"
                                   id="autocomment" <?php if(\dash\data::dataRow_autocomment())
							{
								echo 'checked';
							} ?>>
                            <label for="autocomment"><?php echo T_("Save auto note after add this tag to answer") ?></label>
                        </div>
                        <div data-response='autocomment' <?php if(\dash\data::dataRow_autocomment())
						{/*nothing*/
						}
						else
						{
							echo 'data-response-hide';
						} ?>>
                            <div class="mb-2">
                                <label for="comment"><?php echo T_("Note text") ?></label>
                                <textarea name="comment" class="txt" rows="3"
                                          id="comment"><?php echo \dash\data::dataRow_comment(); ?></textarea>
                            </div>
                        </div>
                        <div class="check1">
                            <input type="checkbox" name="sendsms" id="sendsms" <?php if(\dash\data::dataRow_sendsms())
							{
								echo 'checked';
							} ?>>
                            <label for="sendsms"><?php echo T_("Send notification after add this tag to answer") ?></label>
                        </div>
                        <div data-response='sendsms' <?php if(\dash\data::dataRow_sendsms())
						{/*nothing*/
						}
						else
						{
							echo 'data-response-hide';
						} ?>>
                            <div class="mb-2">
                                <label for="smstext"><?php echo T_("Notification text") ?></label>
                                <textarea name="smstext" class="txt" rows="3"
                                          id="smstext"><?php echo \dash\data::dataRow_smstext(); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>


                <section class="box">
                    <div class="pad">
						<?php if(!\dash\data::dataRow_count() && !\dash\data::dataRow_have_child()) { ?>
                            <p><?php echo T_("You can delete this tag because we are not found any form in that."); ?></p>
						<?php } else { ?>
                            <p><?php echo T_("You can delete this tag and merge all form in this tag by another tag."); ?></p>
						<?php }//endif ?>
                    </div>
                    <footer>
						<?php if(!\dash\data::dataRow_count() && !\dash\data::dataRow_have_child()) { ?>
                            <div class="txtRa"><span data-confirm data-data='{"delete" : "delete"}'
                                                     class="btn-link-danger"><?php echo T_("Remove tag"); ?></span>
                            </div>
						<?php } else { ?>
                            <div class="txtRa"><a
                                        href="<?php echo \dash\url::that() . '/remove?' . \dash\request::fix_get() ?>"
                                        class="btn-link-danger"><?php echo T_("Remove tag"); ?></a></div>
						<?php }//endif ?>
                    </footer>
                </section>
                <nav class="items long">
                    <ul>
                        <li>
                            <a class="f item"
                               href="<?php echo \dash\url::here() . '/form/answer?' . \dash\request::build_query([
									   'id' => \dash\request::get('id'), 'tagid' => \dash\data::dataRow_id(),
								   ]); ?>">
                                <div class="key"><?php echo T_("Show answer by this tag"); ?></div>
                                <div class="value"><?php echo \dash\fit::number(\dash\data::dataRow_count()) ?></div>
                                <div class="go"></div>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>

    </div>
    </form>
</div>
