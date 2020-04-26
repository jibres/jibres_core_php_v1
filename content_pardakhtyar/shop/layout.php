<?php require_once(root. 'content_pardakhtyar/shop/layout-input.php'); ?>


<?php function ADDEDITFORM_shop() {?>
	<div class="f">
		<div class="c4 s12">
			<div class="mRa5">
			<?php IfarsiName(); ?>
			<?php IenglishName(); ?>
			<?php ItelephoneNumberShop(); ?>
			<?php IpostalCode(); ?>
			<?php IbusinessCertificateNumber(); ?>
			<?php IcertificateIssueDate(); ?>
			<?php IcertificateExpiryDate(); ?>
			<?php IDescription(); ?>

			</div>
		</div>
		<div class="c4 s12">
			<div class="mRa5">


			<?php IbusinessCategoryCode(); ?>
			<?php IbusinessSubCategoryCode(); ?>
			<?php IownershipType(); ?>
			<?php IrentalContractNumber(); ?>
			<?php IrentalExpiryDate(); ?>
			<?php IAddress(); ?>
			<?php IcountryCode(); ?>
			<?php IprovinceCode(); ?>


			</div>
		</div>
		<div class="c4 s12">
			<div class="mRa5">

			<?php IcityCode(); ?>
			<?php IbusinessType(); ?>
			<?php IetrustCertificateType(); ?>
			<?php IetrustCertificateIssueDate(); ?>
			<?php IetrustCertificateExpiryDate(); ?>
			<?php IemailAddress(); ?>
			<?php IwebsiteAddress(); ?>

			</div>
		</div>
	</div>

<?php } //endfunction ?>



