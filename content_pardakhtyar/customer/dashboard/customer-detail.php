

<?php function XCustomerDetail() {?>
<form method="post" autocomplete="off">
	<input type="hidden" name="formSubmitType" value="customer">
	<div class="f">
		<div class="c4 s12">
			<div class="mRa5">
			    <?php ImerchantType(); ?>
			    <?php IresidencyType(); ?>
			    <?php IvitalStatus(); ?>
			    <?php Igender(); ?>
			    <?php InationalCode(); ?>
			    <?php IfirstNameFa(); ?>
			</div>
		</div>

		<div class="c4 s12">
			<div class="mRa5">
			    <?php IlastNameFa(); ?>
			    <?php IfatherNameFa(); ?>
			    <?php IfirstNameEn(); ?>
			    <?php IlastNameEn(); ?>
			    <?php IfatherNameEn(); ?>
			</div>
		</div>
		<div class="c4 s12">
			<div class="mRa5">
			    <?php IbirthDate(); ?>
			    <?php IcellPhoneNumber(); ?>
			    <?php ItelephoneNumber(); ?>
			    <?php IemailAddress(); ?>
			    <?php IwebSite(); ?>
			</div>
		</div>
	</div>

	<div data-kerkere='.ShowCustomerFieldDetail' data-kerkere-icon>جزئیات بیشتر</div>

	<div class="ShowCustomerFieldDetail" data-kerkere-content='hide'>
		<div class="example">
			<div class="f">
				<div class="c4 s12">
					<div class="mRa5">
					    <?php Ifax(); ?>
					    <?php IbirthCrtfctNumber(); ?>
					    <?php IbirthCrtfctSerial(); ?>
					    <?php IbirthCrtfctSeriesLetter(); ?>
					    <?php IbirthCrtfctSeriesNumber(); ?>
					    <?php IforeignPervasiveCode(); ?>
					    <?php IcountryCode(); ?>
					    <?php IpassportNumber(); ?>
					</div>
				</div>

				<div class="c4 s12">
					<div class="mRa5">
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
		</div>
	</div>

	<div class="txtRa">
		<button class="btn success"><?php echo T_("Update"); ?></button>
	</div>
</form>
<?php } //endfunction ?>
