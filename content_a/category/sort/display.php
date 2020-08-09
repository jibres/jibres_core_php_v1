<?php
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}
?>

<form method="post" data-sortable data-ratio='16x9' data-willy class="ltr">
<?php foreach ($dataTable as $key => $value) {?>
<?php $loopTitle = \dash\get::index($value, 'title'); ?>

  <div class="roundedBox" data-handle data-gr="1">
    <figure class="overlay" >
      <img src="<?php echo \dash\get::index($value, 'file'); ?>" alt="<?php echo $loopTitle; ?>" data-gr="3">
      <figcaption><h2><?php echo $loopTitle; ?></h2></figcaption>
    </figure>
  </div>
<?php } //endfor ?>
</form>