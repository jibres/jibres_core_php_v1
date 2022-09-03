<?php $dataRow = \dash\data::storeDetail(); ?>
<div class="avand-lg">
	<?php require_once(root . 'content_love/store/storeDetail.php') ?>
    <div class="box">
        <div class="body">
            <h6><?php echo T_("User") ?></h6>
            <div class="row">
                <div class="c-xs-2 c-sm-2">
                    <img class="w100" src="<?php echo \dash\data::userDetail_avatar() ?>">
                </div>
                <div class="c-xs-10 c-sm-10"><?php echo \dash\data::userDetail_displayname() ?>
                    <b><?php echo \dash\data::userDetail_mobile() ?></b></div>
            </div>
            <hr>

            <form method="post" autocomplete="off">
                <div class="switch1 mt-5">
                    <input type="checkbox" id="customer" name="customer" value="1" <?php if(\dash\data::dataRow_customer() === 'yes') { echo 'checked';} ?>>
                    <label for="customer"></label>
                    <label for="customer"><?php echo T_("Is customer?"); ?></label>
                </div>

                <div class="switch1 mt-5">
                    <input type="checkbox" id="staff" name="staff" value="1" <?php if(\dash\data::dataRow_staff() === 'yes') { echo 'checked';} ?>>
                    <label for="staff"></label>
                    <label for="staff"><?php echo T_("Is staff?"); ?></label>
                </div>
                <div class="txtRa">
                    <button class="btn-danger" type="submit"><?php echo T_("Update"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>