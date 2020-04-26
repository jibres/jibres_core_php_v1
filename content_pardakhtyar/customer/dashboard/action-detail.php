
<?php function XAction() {?>
<table class="tbl1 v4">
	<tbody>
		<tr class="positive">
			<td>#</td>
			<td>-</td>
			<td>بررسی اطلاعات</td>
			<td class="collapsing"><span data-ajaxify data-method='post' data-data='{"xtype":"run", "RequestType": "fetch", "id" : "<?php echo \dash\data::dataRowCustomer_id() ?>"}' class="btn block info mA5">ارسال درخواست بررسی</span></td>
		</tr>

		<tr>
			<td>#<?php echo \dash\fit::number(1); ?></td>
			<td>نوع درخواست <?php echo \dash\fit::number(13); ?></td>
			<td>سرویس تعریف مشتری و فروشگاه	</td>
			<td class="collapsing"><span data-ajaxify data-method='post' data-data='{"xtype":"run", "RequestType": 13, "id" : "<?php echo \dash\data::dataRowCustomer_id() ?>"}' class="btn block primary2 mA5">ارسال درخواست</span></td>
		</tr>

		<tr>
			<td>#<?php echo \dash\fit::number(2); ?></td>
			<td>نوع درخواست <?php echo \dash\fit::number(5); ?></td>
			<td>سرویس تعریف پذیرندگی - تعریف پایانه جدید	</td>
			<td class="collapsing"><span data-ajaxify data-method='post' data-data='{"xtype":"run", "RequestType": 5, "id" : "<?php echo \dash\data::dataRowCustomer_id() ?>"}' class="btn block primary2 mA5">ارسال درخواست</span></td>
		</tr>

		<tr>
			<td>#<?php echo \dash\fit::number(3); ?></td>
			<td>نوع درخواست <?php echo \dash\fit::number(6); ?></td>
			<td>سرویس تغییر شباهای متصل به پذیردندگی	</td>
			<td class="collapsing"><span data-ajaxify data-method='post' data-data='{"xtype":"run", "RequestType": 6, "id" : "<?php echo \dash\data::dataRowCustomer_id() ?>"}' class="btn block primary2 mA5">ارسال درخواست</span></td>
		</tr>

		<tr>
			<td>#<?php echo \dash\fit::number(4); ?></td>
			<td>نوع درخواست <?php echo \dash\fit::number(7); ?></td>
			<td>سرویس غیر فعال سازی پایانه	</td>
			<td class="collapsing"><span data-ajaxify data-method='post' data-data='{"xtype":"run", "RequestType": 7, "id" : "<?php echo \dash\data::dataRowCustomer_id() ?>"}' class="btn block primary2 mA5">ارسال درخواست</span></td>
		</tr>

		<tr>
			<td>#<?php echo \dash\fit::number(5); ?></td>
			<td>نوع درخواست <?php echo \dash\fit::number(18); ?></td>
			<td>سرویس فعال سازی مجدد پایانه	</td>
			<td class="collapsing"><span data-ajaxify data-method='post' data-data='{"xtype":"run", "RequestType": 18, "id" : "<?php echo \dash\data::dataRowCustomer_id() ?>"}' class="btn block primary2 mA5">ارسال درخواست</span></td>
		</tr>

		<tr>
			<td>#<?php echo \dash\fit::number(6); ?></td>
			<td>نوع درخواست <?php echo \dash\fit::number(17); ?></td>
			<td>سرویس تغییر فروشگاه	</td>
			<td class="collapsing"><span data-ajaxify data-method='post' data-data='{"xtype":"run", "RequestType": 17, "id" : "<?php echo \dash\data::dataRowCustomer_id() ?>"}' class="btn block primary2 mA5">ارسال درخواست</span></td>
		</tr>

		<tr>
			<td>#<?php echo \dash\fit::number(7); ?></td>
			<td>نوع درخواست <?php echo \dash\fit::number(14); ?></td>
			<td>سرویس اصلاح اطلاعات	</td>
			<td class="collapsing"><span data-ajaxify data-method='post' data-data='{"xtype":"run", "RequestType": 14, "id" : "<?php echo \dash\data::dataRowCustomer_id() ?>"}' class="btn block primary2 mA5">ارسال درخواست</span></td>
		</tr>


	</tbody>
</table>



<?php } //endif ?>
