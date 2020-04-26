

<?php function XShopDetail() {?>
<form method="post" autocomplete="off">
	<input type="hidden" name="formSubmitType" value="shop">
	<input type="hidden" name="shopid" value="<?php echo \dash\data::dataRowShop_id(); ?>">


	<div class="f">
		<div class="c4 s12">
			<div class="mRa5">
			<?php IfarsiName(); ?>
			<?php IenglishName(); ?>
			<?php ItelephoneNumberShop(); ?>
			<?php IpostalCode(); ?>
			<?php IbusinessType(); ?>


			</div>
		</div>
		<div class="c4 s12">
			<div class="mRa5">


			<?php IbusinessCategoryCode(); ?>
			<?php IbusinessSubCategoryCode(); ?>
			<?php IownershipType(); ?>



			</div>
		</div>
		<div class="c4 s12">
			<div class="mRa5">
			<?php IemailAddress_shop(); ?>
			<?php IwebsiteAddress(); ?>

			</div>
		</div>
	</div>
	<div data-kerkere='.ShowShopFieldDetail' data-kerkere-icon>جزئیات بیشتر</div>

	<div class="ShowShopFieldDetail" data-kerkere-content='hide'>
		<div class="example">
			<div class="f">
				<div class="c4 s12">
					<div class="mRa5">
						<?php IbusinessCertificateNumber(); ?>
						<?php IcertificateIssueDate(); ?>
						<?php IcertificateExpiryDate(); ?>
						<?php IcityCode(); ?>
						<?php IetrustCertificateType(); ?>
						<?php IetrustCertificateIssueDate(); ?>

					</div>
				</div>

				<div class="c4 s12">
					<div class="mRa5">
						<?php IetrustCertificateExpiryDate(); ?>
					    <?php IrentalContractNumber(); ?>
						<?php IrentalExpiryDate(); ?>
						<?php IAddress(); ?>
						<?php IcountryCode_shop(); ?>
						<?php IprovinceCode(); ?>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="txtRa">
		<button class="btn success"><?php echo T_("Update"); ?></button>
	</div>
</form>
<?php } //endif ?>