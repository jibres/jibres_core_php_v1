<div class="row">
  <?php foreach (\dash\data::dataTable() as $key => $value) {?>
    <div class="c-xs-6 c-sm-4 c-md-2">
      <div data-ajaxify data-data='{"fileid": "<?php echo a($value, 'id'); ?>"}' class="vcard green mA10"  >
        <img src="<?php echo a($value, 'thumb'); ?>" alt="<?php echo T_("Post image") ?>">
        <div class="content">
          <div class="value"><?php echo a($value, 'filename'); ?></div>
        </div>
      </div>
    </div>
  <?php } //endfor ?>
</div>
<?php \dash\utility\pagination::html(); ?>