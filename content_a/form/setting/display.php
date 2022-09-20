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
                    <div data-response="disableshortlink"  <?php if(a(\dash\data::dataRow(), 'setting', 'disableshortlink'))
					{}else{
						echo 'data-response-hide';
					} ?>>
                    </div>
                    <div class="switch1">
                        <input type="checkbox" name="saveasticket"
                               id="saveasticket" <?php if(a(\dash\data::dataRow(), 'setting', 'saveasticket'))
						{
							echo 'checked';
						} ?>>
                        <label for="saveasticket"><?php echo T_("Save answer as ticket") ?></label>
                        <label for="saveasticket"><?php echo T_("Save answer as ticket") ?></label>
                    </div>

                    <label for="answerlimit"><?php echo T_("Answer limit") ?>
                        <small><?php echo T_("If answer limit is full no body can add new answer to this form"); ?></small></label>
                    <div class="input ltr">
                        <input type="tel" id="answerlimit" name="answerlimit"
                               value="<?php echo \dash\data::dataRow_answerlimit(); ?>" data-format="price">
                    </div>


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
                </div>
            </div>


        </form>
    </div>
</div>
