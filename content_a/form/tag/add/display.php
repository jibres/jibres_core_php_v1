<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-xs-12 c-sm-12 c-lg-8">

		<?php require_once(root . 'content_a/form/formTitle.php'); ?>
        <div class="avand-md">
            <form method="post" autocomplete="off">
                <div class="box">
                    <div class="body">

                        <label for="itagname"><?php echo T_("Title"); ?></label>
                        <div class="input">
                            <input type="text" name="tag" id="itagname"
                                   placeholder='<?php echo T_("Tag name"); ?>' <?php \dash\layout\autofocus::html() ?>
                                   maxlength='50' minlength="1" required>
                        </div>
                    </div>
                    <footer class="txtRa">
                        <button class="btn-primary"><?php echo T_("Add"); ?></button>
                    </footer>
                </div>
            </form>
        </div>
    </div>