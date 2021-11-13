<div class="avand-md">

<table class="tbl1 v3 font-16 ltr">
	<tbody>
		<?php foreach (\dash\data::dataTable() as $key => $value) {?>
		<tr>
			<td class="text-left"><a class="link" href="<?php echo \dash\url::here(); ?>/log?caller=<?php echo $key; ?>"> <?php echo $key; ?></a></td>
			<td class="text-left"><?php echo \dash\fit::number($value); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
