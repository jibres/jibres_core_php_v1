<div class="row">
	<div class="c-xs-12 c-sm-12 c-md-4">
		<?php require_once(root. 'content_a/form/itemLink.php');
		 ?>
	</div>
	<div class="c-xs-12 c-sm-12 c-md-8">


	<div class="box">
		<div class="body">
			<div class="txtB">
				<?php echo \dash\data::dataRow_title(); ?>
			</div>
		</div>
	</div>

	<?php
$dataTable = \dash\data::formItems();

if(!is_array($dataTable))
{
  $dataTable = [];
}
?>
<div class="msg fs14"><?php echo T_("Select any of the items you want and move them to sort") ?></div>
<form method="post" data-sortable data-ratio='16x9' data-willy class="ltr">
<?php foreach ($dataTable as $key => $value) {?>
<?php $loopTitle = \dash\get::index($value, 'title'); ?>

  <div class="roundedBox" data-handle data-gr="<?php echo rand(1, 20); ?>">
    <figure class="overlay" >
    	<input type="hidden" name="sort[]" value="<?php echo \dash\get::index($value, 'id'); ?>">
    	<img src="<?php echo \dash\get::index($value, 'file'); ?>" alt="<?php echo $loopTitle; ?>" data-gr="3">
      <figcaption><h2><?php echo $loopTitle; ?></h2></figcaption>
    </figure>
  </div>
<?php } //endfor ?>
</form>


	</div>
</div>
