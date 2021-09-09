<?php
$all_features = \lib\features\get::all_list();

if(!is_array($all_features))
{
	$all_features = [];
}

?>

<?php foreach ($all_features as $key => $value) {?>
	<div class="box">
		<div class="pad">
			<div class="f">
				<div class="c"><?php echo a($value, 'title') ?></div>
				<div class="c"><?php echo a($value, 'description') ?></div>
				<div class="c"><?php echo \dash\fit::number(a($value, 'price')) ?></div>
			</div>
		</div>
	</div>
<?php } //endfor ?>