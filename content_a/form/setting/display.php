<?php
$isPublic = \dash\data::dataRow_privacy() !== 'private';
?>
<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 c-xl-3 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-lg-8 c-xl-9">
		<?php require_once(root . 'content_a/form/formTitle.php'); ?>
        <form method="post" autocomplete="off" id="form1">
            <div class="box">
                <div class="pad">

                    <label for="ititle"><?php echo T_("Title") ?> <small
                                class="text-red-800">* <?php echo T_("Required") ?></small></label>
                    <div class="input">
                        <input type="text" id="ititle" name="title" value="<?php echo \dash\data::dataRow_title(); ?>">
                    </div>
					<?php if($isPublic): ?>
                        <div class="mb-2">
                            <label for="desc"><?php echo T_("Description") ?></label>
                            <textarea name="desc" class="txt" rows="7" id="desc"
                                      placeholder="<?php echo T_("Description") ?>"><?php if(\dash\data::dataRow_desc())
								{
									echo strip_tags(\dash\data::dataRow_desc());
								} ?></textarea>
                        </div>


                        <div class="mb-2">
                            <label><?php echo T_("Banner image in form page"); ?></label>
                            <div data-uploader data-name='file' data-final='#finalImagefile1'
                                 data-file-max-size='<?php echo \dash\data::maxFileSize() ?>'>
                                <input type="file" accept="image/*" id="file1">
                                <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
                                <label for="file1"><img id="finalImagefile1"
														<?php if(\dash\data::dataRow_file()) { ?>src="<?php echo \dash\data::dataRow_file(); ?>" <?php } //endif ?>
                                                        alt="<?php echo T_("File") ?>"></label>
                            </div>
                        </div>
					<?php endif; ?>

                </div>
            </div>
            <div class="box">
                <div class="pad">

                    <div class="switch1">
                        <input type="checkbox" name="saveasticket"
                               id="saveasticket" <?php if(a(\dash\data::dataRow(), 'setting', 'saveasticket'))
						{
							echo 'checked';
						} ?>>
                        <label for="saveasticket"><?php echo T_("Save answer as ticket") ?></label>
                        <label for="saveasticket"><?php echo T_("Save answer as ticket") ?></label>
                    </div>

                    <div class="switch1">
                        <input type="checkbox" name="loginrequired"
                               id="loginrequired" <?php if(a(\dash\data::dataRow(), 'setting', 'loginrequired'))
						{
							echo 'checked';
						} ?>>
                        <label for="loginrequired"><?php echo T_("Force user to login and continue") ?></label>
                        <label for="loginrequired"><?php echo T_("Force user to login and continue") ?> <small><?php echo T_("User must be login to answer to this form"); ?></small></label>
                    </div>

                    <div class="switch1">
                        <input type="checkbox" name="uniquesession"
                               id="uniquesession" <?php if(a(\dash\data::dataRow(), 'setting', 'uniquesession'))
						{
							echo 'checked';
						} ?>>
                        <label for="uniquesession"><?php echo T_("Check unique session") ?></label>
                        <label for="uniquesession"><?php echo T_("Check unique session") ?> <small><?php echo T_("Every user (session or ip-agent) can answer one time"); ?></small></label>
                    </div>


                    <?php if($isPublic) : ?>

                        <label for="islug"><?php echo T_("Slug") ?></label>
                        <div class="input ltr">
                            <label for="islug" class="addon"><?php echo \lib\store::url('raw') . '/f/' ?></label>
                            <input type="text" id="islug" name="slug" value="<?php echo \dash\data::dataRow_slug(); ?>">
                        </div>

                        <div class="switch1">
                            <input type="checkbox" name="disableshortlink"
                                   id="disableshortlink" <?php if(a(\dash\data::dataRow(), 'setting', 'disableshortlink'))
							{
								echo 'checked';
							} ?>>
                            <label for="disableshortlink"><?php echo T_("Disable short link") ?></label>
                            <label for="disableshortlink"><?php echo T_("Disable short link") ?></label>
                        </div>
                        <div data-response="disableshortlink" <?php if(a(\dash\data::dataRow(), 'setting', 'disableshortlink'))
						{
						}
						else
						{
							echo 'data-response-hide';
						} ?>>
                        </div>
					<?php endif; ?>

                </div>
            </div>
			<?php if($isPublic): ?>
                <div class="box">
                    <div class="pad">


                        <label for="answerlimit"><?php echo T_("Answer limit") ?>
                            <small><?php echo T_("If answer limit is full no body can add new answer to this form"); ?></small></label>
                        <div class="input ltr">
                            <input type="tel" id="answerlimit" name="answerlimit"
                                   value="<?php echo \dash\data::dataRow_answerlimit(); ?>" data-format="price">
                        </div>


                        <label for="timelimit"><?php echo T_("Total time limit (second)") ?>
                            <small><?php echo T_("e.g. For take exam"); ?></small></label>
                        <div class="input ltr">
                            <input type="tel" id="timelimit" name="timelimit"
                                   value="<?php echo a(\dash\data::dataRow(), 'setting', 'timelimit'); ?>"
                                   data-format="price">
                        </div>

                        <div class="switch1">
                            <input type="checkbox" name="randqcheck"
                                   id="randqcheck" <?php if(a(\dash\data::dataRow(), 'setting', 'randomquestion'))
							{
								echo 'checked';
							} ?>>
                            <label for="randqcheck"><?php echo T_("Display random question") ?></label>
                            <label for="randqcheck"><?php echo T_("Display random question") ?></label>
                        </div>
                        <div data-response="randqcheck" <?php if(a(\dash\data::dataRow(), 'setting', 'randomquestion'))
						{
						}
						else
						{
							echo 'data-response-hide';
						} ?>>
                            <div class="alert-secondary">
                                <?php echo T_("To take the test, you can register as many questions as you need and specify here that a limited number of questions will be asked randomly to each audience.
                                Be careful that the mandatory questions are not affected by random selection, that is, the mandatory questions will be asked to everyone") ?>
                            </div>

                            <label for="randomquestion"><?php echo T_("Random question count") ?></label>
                            <div class="input ltr">
                                <input type="tel" id="randomquestion" name="randomquestion"
                                       value="<?php echo a(\dash\data::dataRow(), 'setting', 'randomquestion'); ?>"
                                       data-format="price">
                            </div>

                        </div>


                    </div>
                </div>
			<?php endif; ?>

        </form>
    </div>
</div>
