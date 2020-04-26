<?php require_once(root. 'content_pardakhtyar/customer/layout.php'); ?>
<?php require_once(root. 'content_pardakhtyar/shop/layout-input.php'); ?>


<?php require_once(root. 'content_pardakhtyar/customer/dashboard/customer-detail.php'); ?>
<?php require_once(root. 'content_pardakhtyar/customer/dashboard/shop-detail.php'); ?>
<?php require_once(root. 'content_pardakhtyar/customer/dashboard/shaba-detail.php'); ?>
<?php require_once(root. 'content_pardakhtyar/customer/dashboard/acceptor-detail.php'); ?>
<?php require_once(root. 'content_pardakhtyar/customer/dashboard/terminal-detail.php'); ?>
<?php require_once(root. 'content_pardakhtyar/customer/dashboard/action-detail.php'); ?>





	<table class="tbl1 v10 fs14">
		<tbody>
			<tr>

				<td><?php echo \dash\data::dataRowCustomer_firstNameFa(); ?></td>
				<td><?php echo \dash\data::dataRowCustomer_lastNameFa(); ?></td>

				<td><?php echo \dash\data::dataRowCustomer_gender_title(); ?></td>
				<td><?php echo \dash\data::dataRowCustomer_birthDate_title(); ?></td>


				<td><?php echo \dash\data::dataRowCustomer_residencyType_title(); ?></td>
				<td><?php echo \dash\data::dataRowCustomer_merchantType_title(); ?></td>

			</tr>
			<tr>
				<td>شماره پیگیری</td>
				<td class="selectable"><?php echo \dash\data::dataRowCustomer_trackingNumber(); ?></td>
				<td>وضعیت</td>
				<td class="txtB"><?php echo \dash\data::dataRowCustomer_status(); ?></td>
				<td class="collapsing" colspan="2">
					<a href="<?php echo \dash\url::here(); ?>/check?id=<?php echo \dash\data::dataRowCustomer_id(); ?>&table=customer&fetch=1&trackingNumber=<?php echo \dash\data::dataRowCustomer_trackingNumber(); ?>" class="btn primary">جزئیات</a>
				</td>
			</tr>
		</tbody>
	</table>



<div class="cbox">
	<h2 data-kerkere-icon data-kerkere='.ShowXAction'>عملیات</h2>
	<div class="ShowXAction">
		<?php XAction(); ?>
		<small class="fc-mute">عملیات</small>
	</div>
</div>

<div class="cbox">
	<h2 data-kerkere-icon data-kerkere='.ShowXCustomerDetail'>اطلاعات متقاضی</h2>
	<div class="ShowXCustomerDetail" data-kerkere-content2='hide'>
		<?php XCustomerDetail(); ?>
		<small class="fc-mute">اطلاعات متقاضی</small>
	</div>
</div>

<div class="cbox">
	<h2 data-kerkere-icon data-kerkere='.ShowXShopDetail'>فروشگاه</h2>
	<div class="ShowXShopDetail" data-kerkere-content2='hide'>
		<?php XShopDetail(); ?>
		<small class="fc-mute">فروشگاه</small>
	</div>
</div>

<div class="cbox">
	<h2 data-kerkere-icon data-kerkere='.ShowXIbanDetail'>اطلاعات شبا</h2>
	<div class="ShowXIbanDetail" data-kerkere-content2='hide'>
		<?php XIbanDetail(); ?>
		<small class="fc-mute">اطلاعات شبا</small>
	</div>
</div>

<div class="cbox">
	<h2 data-kerkere-icon data-kerkere='.ShowXAcceptorDetail'>پذیرندگی</h2>
	<div class="ShowXAcceptorDetail" data-kerkere-content2='hide'>
		<?php XAcceptorDetail(); ?>
		<small class="fc-mute">پذیرندگی</small>
	</div>
</div>

<div class="cbox">
	<h2 data-kerkere-icon data-kerkere='.ShowXTerminalDetail'>ترمینال</h2>
	<div class="ShowXTerminalDetail" data-kerkere-content2='hide'>
		<?php XTerminalDetail(); ?>
		<small class="fc-mute">ترمینال</small>
	</div>
</div>





