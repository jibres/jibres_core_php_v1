<?php
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}
?>

<div data-sortable data-ratio='16x9' class="ltr">
<?php foreach ($dataTable as $key => $value) {?>
<?php $loopTitle = \dash\get::index($value, 'title'); ?>

  <div class="roundedBox" data-handle>
    <div class="overlay">
      <figure>
        <img src="<?php echo \dash\get::index($value, 'file'); ?>" alt="<?php echo $loopTitle; ?>">
        <figcaption><h2><?php echo $loopTitle; ?></h2></figcaption>
      </figure>
    </div>
  </div>
<?php } //endfor ?>
</div>