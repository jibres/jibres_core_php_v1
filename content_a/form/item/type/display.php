<?php
	$value = \dash\data::itemDetail();
?>

<section class="f" data-option='product-setting-image-ratio'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Item type");?></h3>
      <div class="body">
        <p><?php echo T_("You can change item type");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
      <div class="action">
        <input type="hidden" name="runaction_ratio" value="1">
        <select name="type" class="select22"><?php foreach (\dash\data::itemType() as $type_key => $type_value) {?><optgroup label="<?php echo \dash\get::index($type_value, 'title'); ?>"><?php if(isset($type_value['list']) && is_array($type_value['list'])) { foreach ($type_value['list'] as $k => $v) {?><option value="<?php echo $v['key'] ?>" <?php if(\dash\get::index($value, 'type') === $v['key']) {echo 'selected';} ?>><?php echo $v['title']; ?></option><?php } /*endfor*/  } //endif?></optgroup><?php } //endif ?>
									</select>
      </div>
  </form>
</section>
