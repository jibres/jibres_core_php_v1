<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-xs-12 c-sm-12 c-lg-8">
		<?php require_once(root . 'content_a/form/formTitle.php'); ?>
        <form method="post" autocomplete="off" id="form1">
            <div class="box">
                <div class="pad">
                    <label for="ititle"><?php echo T_("Title") ?> <small
                                class="text-red-800">* <?php echo T_("Required") ?></small></label>
                    <div class="input">
                        <input type="text" id="ititle" name="title" value="<?php echo \dash\data::dataRow_title(); ?>">
                    </div>

                    <label for="islug"><?php echo T_("Slug") ?></label>
                    <div class="input ltr">
                        <label for="islug" class="addon"><?php echo \lib\store::url('raw') . '/f/' ?></label>
                        <input type="text" id="islug" name="slug" value="<?php echo \dash\data::dataRow_slug(); ?>">
                    </div>

                    <div class="mb-2">
                        <label for="desc"><?php echo T_("Description") ?></label>
                        <textarea name="desc" class="txt" rows="3" id="desc"
                                  placeholder="<?php echo T_("Description") ?>"><?php if (\dash\data::dataRow_desc())
							{
								echo strip_tags(\dash\data::dataRow_desc());
							} ?></textarea>
                    </div>

                    <div class="switch1">
                        <input type="checkbox" name="saveasticket"
                               id="saveasticket" <?php if (a(\dash\data::dataRow(), 'setting', 'saveasticket'))
						{
							echo 'checked';
						} ?>>
                        <label for="saveasticket"><?php echo T_("Save answer as ticket") ?></label>
                        <label for="saveasticket"><?php echo T_("Save answer as ticket") ?></label>
                    </div>

                    <label for="answerlimit"><?php echo T_("Answer limit") ?> <small><?php echo T_("If answer limit is full no body can add new answer to this form"); ?></small></label>
                    <div class="input ltr">

                        <input type="tel" id="answerlimit" name="answerlimit" value="<?php echo \dash\data::dataRow_answerlimit(); ?>" data-format="price">
                    </div>


                    <div class="mb-2">
                        <div data-uploader data-name='file' data-final='#finalImagefile1'
                             data-file-max-size='<?php echo \dash\data::maxFileSize() ?>'>
                            <input type="file" accept="image/*" id="file1">
                            <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
                            <label for="file1"><img id="finalImagefile1"
													<?php if (\dash\data::dataRow_file()) { ?>src="<?php echo \dash\data::dataRow_file(); ?>" <?php } //endif ?>
                                                    alt="<?php echo T_("File") ?>"></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box hidden">
                <div class="pad">
                    <div class="switch1">
                        <input type="checkbox" name="reportpagecheck"
                               id="reportpagecheck" <?php if (a(\dash\data::dataRow(), 'reportpage'))
						{
							echo 'checked';
						} ?>>
                        <label for="reportpagecheck"><?php echo T_("Have special print page for answers?") ?></label>
                        <label for="reportpagecheck"><?php echo T_("Have special print page for answers?") ?></label>
                    </div>

                    <div data-response="reportpagecheck" <?php if(!\dash\data::dataRow_reportpage()) { echo 'data-response-hide'; } ?>>
                        <?php if(false): ?>
                        <div class="ltr h-1/2 w-full rounded-lg overflow-hidden">
                            <input type="hidden" name="savehtml" value="html">
                            <pre id="codeEditorLive" data-code-editor="html" data-code-editor-sync="[name='html']" class="h-full"><?php echo htmlentities(\dash\data::myHtmlText()); ?></pre>
                            <textarea name="html" class="hide ltr w-full h-full p-5 resize-none mt-5" placeholder="Write yout HTML here ..."><?php echo htmlentities(\dash\data::myHtmlText()); ?></textarea>
                        </div>
                        <?php endif; ?>
                        <textarea name="html" class="ltr w-full h-full p-5 resize-none mt-5" placeholder="Write yout HTML here ..."><?php echo htmlentities(strval(\dash\data::dataRow_reportpage())); ?></textarea>
                    </div>


                </div>
            </div>

        </form>
    </div>
</div>
