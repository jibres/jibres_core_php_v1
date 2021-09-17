<?php $dashboardData = \dash\data::dashboardData(); ?>

    <div class="box">
      <div class='font-16'>
        <select class="select22" data-model='html' data-ajax--url="<?php echo \dash\url::here() ?>/setting/search/full" data-shortkey-search data-placeholder="<?php echo T_("Search") ?>"></select>
      </div>
    </div>

<?php if(\dash\permission::check('_group_products')) {?>
   <div id="chartdiv" class="box chart x400" data-abc='a/homepage'></div>
<?php } //endif ?>
