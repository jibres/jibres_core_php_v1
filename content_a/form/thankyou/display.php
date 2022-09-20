<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 c-xl-3 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-lg-8 c-xl-9">
		<?php require_once(root . 'content_a/form/formTitle.php'); ?>
        <form method="post" autocomplete="off" id="form1">
            <div class="box">
                <div class="pad">
                    <label for="redirect"><?php echo T_("Redirect after submit") ?></label>
                    <div class="input">
                        <input type="url" name="redirect" value="<?php echo \dash\data::dataRow_redirect(); ?>">
                    </div>
                    <div class="mb-2">
                        <label for="endmessage"><?php echo T_("End message") ?></label>
                        <textarea name="endmessage" class="txt" rows="7" id="endmessage"
                                  placeholder="<?php echo T_("End message") ?>"><?php echo \dash\data::dataRow_endmessage(); ?></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
