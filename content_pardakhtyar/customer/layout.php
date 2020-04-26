<?php require_once(root. 'content_pardakhtyar/customer/layout-input.php'); ?>
<?php function ADDEDITFORM() {?>

	<div class="f">
		<div class="c4 s12">
			<div class="mRa5">
		    <?php ImerchantType(); ?>
		    <?php IresidencyType(); ?>
		    <?php IvitalStatus(); ?>
		    <?php Igender(); ?>
		    <?php InationalCode(); ?>
		    <?php IfirstNameFa(); ?>
		    <?php IlastNameFa(); ?>
		    <?php IfatherNameFa(); ?>
		    <?php IfirstNameEn(); ?>
		    <?php IlastNameEn(); ?>
		    <?php IfatherNameEn(); ?>
		    <?php IbirthDate(); ?>
			</div>
		</div>
		<div class="c4 s12">
			<div class="mRa5">
		    <?php IcellPhoneNumber(); ?>
		    <?php ItelephoneNumber(); ?>
		    <?php IemailAddress(); ?>
		    <?php IwebSite(); ?>
		    <?php Ifax(); ?>
		    <?php IbirthCrtfctNumber(); ?>
		    <?php IbirthCrtfctSerial(); ?>
		    <?php IbirthCrtfctSeriesLetter(); ?>
		    <?php IbirthCrtfctSeriesNumber(); ?>
			</div>
		</div>
		<div class="c4 s12">
			<div class="mRa5">
		    <?php IforeignPervasiveCode(); ?>
		    <?php IcountryCode(); ?>
		    <?php IpassportNumber(); ?>
		    <?php IpassportExpireDate(); ?>

		    <?php InationalLegalCode(); ?>
		    <?php IregisterNumber(); ?>
		    <?php IcomNameFa(); ?>
		    <?php IregisterDate(); ?>
		    <?php IcomNameEn(); ?>
		    <?php IcommercialCode(); ?>
			</div>
		</div>
	</div>

<?php } //endfunction ?>