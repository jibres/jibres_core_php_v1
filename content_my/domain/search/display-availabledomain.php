<div class="f">

<?php foreach (\dash\data::dataTable() as $key => $value) {?>
    <div class="c2 pA5">
        <a class="stat x70 available" href="<?php echo \dash\url::this(). '/buy/'. \dash\get::index($value, 'name'); ?>">
            <h3><?php echo T_("Available") ?></h3>
            <div class="val ltr"><?php echo \dash\get::index($value, 'name'); ?></div>
        </a>
    </div>
<?php } //endfor ?>
</div>
<?php \dash\utility\pagination::html(); ?>