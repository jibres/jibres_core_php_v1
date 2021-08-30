

<div class="row">
  <?php foreach (\dash\data::dataTable() as $key => $value) {
    $myJson           = \dash\request::get();
    unset($myJson['callback']);
    $myJson['fileid'] = a($value, 'id');
    $myJson           = json_encode($myJson);
  ?>
    <div class="c-xs-6 c-sm-4 c-md-2">
      <div data-ajaxify data-action='<?php echo \dash\request::get('callback'); ?>' data-data='<?php echo $myJson ?>' class="vcard mB10">
        <img src="<?php echo a($value, 'thumb'); ?>" alt="<?php echo T_("Post image") ?>">
      </div>
    </div>
  <?php } //endfor ?>
</div>
<?php \dash\utility\pagination::html(); ?>
