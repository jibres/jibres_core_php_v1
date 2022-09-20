<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 c-xl-3 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-lg-8 c-xl-9">
        <?php require_once (root. 'content_a/form/formTitle.php')?>
        <div class="avand-md">
            <form method="post" autocomplete="off" id="form1">
                <div class="box">
                    <header><h2><?php echo T_("Create duplicate form") ?></h2></header>
                    <div class="pad">
                        <label for="title"><?php echo T_("New Title") ?></label>
                        <div class="input">
                            <input type="text" name="title" value="<?php echo \dash\data::dataRow_title(); ?>">
                        </div>
                    </div>
                    <footer class="txtRa">
                        <button class="btn master"><?php echo T_("Duplicate"); ?></button>
                    </footer>
                </div>
            </form>
        </div>
    </div>

