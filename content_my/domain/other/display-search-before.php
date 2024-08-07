<?php if(\dash\data::countGroupByStatusLink() > 1) {?>
<div class="row">

    <?php if(\dash\data::groupByStatus_maybe() > 0) {?>
    <div class="c-xs-12 c-sm-4">
        <a href="<?php echo \dash\url::that(). '?list=renew' ?>" class="stat x70 <?php if(\dash\request::get('list') == 'renew' || !\dash\request::get('list')) { echo ' active';} ?>" >
            <h3><?php echo T_("Only renewed"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(\dash\data::groupByStatus_maybe()); ?></div>
        </a>
    </div>
    <?php } //endif ?>
    <?php if(\dash\data::groupByStatus_imported() > 0) {?>
    <div class="c-xs-12 c-sm-4">
        <a href="<?php echo \dash\url::that(). '?list=import' ?>" class="stat x70 <?php if(\dash\request::get('list') == 'import') { echo ' active';} ?>" >
            <h3><?php echo T_("Imported Domain"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(\dash\data::groupByStatus_imported()); ?></div>
        </a>
    </div>
    <?php } //endif ?>
    <?php if(\dash\data::groupByStatus_available() > 0) {?>
    <div class="c-xs-12 c-sm-4">
        <a href="<?php echo \dash\url::that(). '?list=available' ?>" class="stat x70 <?php if(\dash\request::get('list') == 'available') { echo ' active';} ?>" >
            <h3><?php echo T_("Search History"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(\dash\data::groupByStatus_available()); ?></div>
        </a>
    </div>
    <?php } //endif ?>

</div>
<?php } //endif ?>
<?php require_once(root. 'content_my/domain/need_verify_email.php'); ?>