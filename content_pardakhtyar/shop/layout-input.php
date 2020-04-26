
<?php function IfarsiName() {?>
<label for="i_farsiName">farsiName <span class="mLa10">نام فارسی فروشگاه</span></label>
<div class="input">
	<input type="text" id="i_farsiName" name="farsiName" value="<?php echo \dash\data::dataRowShop_farsiName(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IenglishName() {?>
<label for="i_englishName">englishName <span class="mLa10">نام انگلیسی فروشگاه</span></label>
<div class="input">
	<input type="text" id="i_englishName" name="englishName" value="<?php echo \dash\data::dataRowShop_englishName(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function ItelephoneNumberShop() {?>
<label for="i_telephoneNumber">telephoneNumber <span class="mLa10">شماره تلفن ثابت</span></label>
<div class="input">
	<input type="text" id="i_telephoneNumber" name="telephoneNumber" value="<?php echo \dash\data::dataRowShop_telephoneNumber(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IpostalCode() {?>
<label for="i_postalCode">postalCode <span class="mLa10">کد پستی</span></label>
<div class="input">
	<input type="text" id="i_postalCode" name="postalCode" value="<?php echo \dash\data::dataRowShop_postalCode(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IbusinessCertificateNumber() {?>
<label for="i_businessCertificateNumber">businessCertificateNumber <span class="mLa10">شماره جواز کسب</span></label>
<div class="input">
	<input type="text" id="i_businessCertificateNumber" name="businessCertificateNumber" value="<?php echo \dash\data::dataRowShop_businessCertificateNumber(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IcertificateIssueDate() {?>
<label for="i_certificateIssueDate">certificateIssueDate <span class="mLa10">تاریخ صدور جواز کسب</span></label>
<div class="input">
	<input type="text" id="i_certificateIssueDate" name="certificateIssueDate" value="<?php echo \dash\data::dataRowShop_certificateIssueDate(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IcertificateExpiryDate() {?>
<label for="i_certificateExpiryDate">certificateExpiryDate <span class="mLa10">تاریخ اعتبار جواز کسب</span></label>
<div class="input">
	<input type="text" id="i_certificateExpiryDate" name="certificateExpiryDate" value="<?php echo \dash\data::dataRowShop_certificateExpiryDate(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IDescription_shop() {?>
<label for="i_Description">Description <span class="mLa10">توضیحات</span></label>
<div class="input">
	<input type="text" id="i_Description" name="Description" value="<?php echo \dash\data::dataRowShop_Description(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IbusinessCategoryCode() {?>
<label for="i_businessCategoryCode">businessCategoryCode <span class="mLa10">کد صنف</span></label>
<div class="input">
	<input type="text" id="i_businessCategoryCode" name="businessCategoryCode" value="<?php echo \dash\data::dataRowShop_businessCategoryCode(); ?>" placeholder="4816" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IbusinessSubCategoryCode() {?>
<label for="i_businessSubCategoryCode">businessSubCategoryCode <span class="mLa10">کد تکمیلی صنف</span></label>
<div class="input">
	<input type="text" id="i_businessSubCategoryCode" name="businessSubCategoryCode" value="<?php echo \dash\data::dataRowShop_businessSubCategoryCode(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>



<?php function IownershipType() {?>
<label for="i_ownershipType">ownershipType <span class="mLa10">نوع مالکیت</span></label>
<select name="ownershipType" class="ui dropdown select">
  <option value=""><i><?php echo T_("Please select one item"); ?></i></option>
  <option value="0" <?php if(\dash\data::dataRowShop() && \dash\data::dataRowShop_ownershipType() == '0'){echo 'selected';} ?>>مالک</option>
  <option value="1" <?php if(\dash\data::dataRowShop() && \dash\data::dataRowShop_ownershipType() == '1'){echo 'selected';} ?>>مستاجر</option>
</select>

<?php } //endfunction ?>


<?php function IrentalContractNumber() {?>
<label for="i_rentalContractNumber">rentalContractNumber <span class="mLa10">شماره قرارداد اجاره</span></label>
<div class="input">
	<input type="text" id="i_rentalContractNumber" name="rentalContractNumber" value="<?php echo \dash\data::dataRowShop_rentalContractNumber(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IrentalExpiryDate() {?>
<label for="i_rentalExpiryDate">rentalExpiryDate <span class="mLa10">تاریخ اتمام قرارداد اجاره</span></label>
<div class="input">
	<input type="text" id="i_rentalExpiryDate" name="rentalExpiryDate" value="<?php echo \dash\data::dataRowShop_rentalExpiryDate(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IAddress() {?>
<label for="i_Address">Address <span class="mLa10">آدرس</span></label>
<div class="input">
	<input type="text" id="i_Address" name="Address" value="<?php echo \dash\data::dataRowShop_Address(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IcountryCode_shop() {?>
<label for="i_countryCode">countryCode <span class="mLa10">کد کشور</span></label>
<div class="input">
	<input type="text" id="i_countryCode" name="countryCode" value="<?php echo \dash\data::dataRowShop_countryCode(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IprovinceCode() {?>
<label for="i_provinceCode">provinceCode <span class="mLa10">کد استان</span></label>
<div class="input">
	<input type="text" id="i_provinceCode" name="provinceCode" value="<?php echo \dash\data::dataRowShop_provinceCode(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IcityCode() {?>
<label for="i_cityCode">cityCode <span class="mLa10">کد شهر</span></label>
<div class="input">
	<input type="text" id="i_cityCode" name="cityCode" value="<?php echo \dash\data::dataRowShop_cityCode(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>





<?php function IbusinessType() {?>
<label for="i_businessType">businessType <span class="mLa10">نوع فعالیت فروشگاه</span></label>
<select name="businessType" class="ui dropdown select">
  <option value=""><i><?php echo T_("Please select one item"); ?></i></option>
  <option value="0" <? if (\dash\data::dataRowShop() && \dash\data::dataRowShop_businessType() == '0' ){ echo 'selected';} ?>>فیزیکی</option>
  <option value="1" <? if (\dash\data::dataRowShop() && \dash\data::dataRowShop_businessType() == '1' ){ echo 'selected';} ?>>فیزیکی و مجازی</option>
  <option value="2" <? if (\dash\data::dataRowShop() && \dash\data::dataRowShop_businessType() == '2' ){ echo 'selected';} ?>>مجازی</option>
</select>

<?php } //endfunction ?>




<?php function IetrustCertificateType() {?>
<label for="i_etrustCertificateType">etrustCertificateType <span class="mLa10">نوع نماد اعتماد الکترونیکی</span></label>
<select name="etrustCertificateType" class="ui dropdown select">
  <option value=""><i><?php echo T_("Please select one item"); ?></i></option>
  <option value="0" <? if (\dash\data::dataRowShop() && \dash\data::dataRowShop_etrustCertificateType() == '0' ){ echo 'selected';} ?>>یک ستاره</option>
  <option value="1" <? if (\dash\data::dataRowShop() && \dash\data::dataRowShop_etrustCertificateType() == '1' ){ echo 'selected';} ?>>دو ستاره</option>
</select>

<?php } //endfunction ?>


<?php function IetrustCertificateIssueDate() {?>
<label for="i_etrustCertificateIssueDate">etrustCertificateIssueDate <span class="mLa10">تاریخ صدور نماد الکترونیکی</span></label>
<div class="input">
	<input type="text" id="i_etrustCertificateIssueDate" name="etrustCertificateIssueDate" value="<?php echo \dash\data::dataRowShop_etrustCertificateIssueDate(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IetrustCertificateExpiryDate() {?>
<label for="i_etrustCertificateExpiryDate">etrustCertificateExpiryDate <span class="mLa10">تاریخ اتمام اعتبار نماد الکترونیکی</span></label>
<div class="input">
	<input type="text" id="i_etrustCertificateExpiryDate" name="etrustCertificateExpiryDate" value="<?php echo \dash\data::dataRowShop_etrustCertificateExpiryDate(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IemailAddress_shop() {?>
<label for="i_emailAddress">emailAddress <span class="mLa10">آدرس پست الکترونیکی</span></label>
<div class="input">
	<input type="text" id="i_emailAddress" name="emailAddress" value="<?php echo \dash\data::dataRowShop_emailAddress(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>


<?php function IwebsiteAddress() {?>
<label for="i_websiteAddress">websiteAddress <span class="mLa10">آدرس وب‌سایت</span></label>
<div class="input">
	<input type="text" id="i_websiteAddress" name="websiteAddress" value="<?php echo \dash\data::dataRowShop_websiteAddress(); ?>" maxlength="255">
</div>
<?php } //endfunction ?>





