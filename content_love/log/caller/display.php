<div class="avand-md">

<table class="tbl1 v1 font-16">
	<tbody>
		<?php foreach (\dash\data::dataTable() as $key => $value) {?>
		<tr>
			<td><a class="link" href="<?php echo \dash\url::here(); ?>/log?caller=<?php echo $key; ?>"> <?php echo $key; ?></a></td>
			<td><?php echo \dash\fit::number($value); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
