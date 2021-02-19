<div class="row">
  <?php foreach (\dash\data::dataTable() as $key => $value) {?>
    <div class="c-xs-6 c-sm-4 c-md-2">
      <div data-ajaxify data-data='{"fileid": "<?php echo a($value, 'id'); ?>"}' class="vcard mB10">
        <img src="<?php echo a($value, 'thumb'); ?>" alt="<?php echo T_("Post image") ?>">
      </div>
    </div>
  <?php } //endfor ?>
</div>
<?php \dash\utility\pagination::html(); ?>