<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-xs-12 c-sm-12 c-lg-8">
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

        </form>
    </div>
</div>
