<?php
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}
?>
<div class="msg fs14"><?php echo T_("Select any of the tags you want and move them to sort") ?></div>
<form method="post" data-sortable data-ratio='16x9' data-willy class="ltr">
<?php foreach ($dataTable as $key => $value) {?>
<?php $loopTitle = a($value, 'title'); ?>

  <div class="roundedBox" data-handle data-gr="<?php echo rand(1, 20); ?>">
    <figure class="overlay" >
    	<input type="hidden" name="sort[]" value="<?php echo a($value, 'id'); ?>">
      <img src="<?php echo a($value, 'file'); ?>" alt="<?php echo $loopTitle; ?>" data-gr="3">
      <figcaption><h2><?php echo $loopTitle; ?></h2></figcaption>
    </figure>
  </div>
<?php } //endfor ?>
</form>