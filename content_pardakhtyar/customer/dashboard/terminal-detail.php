
<?php function XTerminalDetail() {?>

<form method="post" autocomplete="off">
	<input type="hidden" name="formSubmitType" value="terminal">
	<input type="hidden" name="terminalid" value="<?php echo \dash\data::dataRowTerminal_id(); ?>">
	<div class="f">
		<div class="c4 s12">
			<div class="mRa5">


<?php Isequence(); ?>
<?php IterminalNumber(); ?>
<?php IterminalType(); ?>
<?php IsetupDate(); ?>


			</div>
		</div>

		<div class="c4 s12">
			<div class="mRa5">

			</div>
		</div>
		<div class="c4 s12">
			<div class="mRa5">

			</div>
		</div>
	</div>

	<div data-kerkere='.ShowTerminalFieldDetail' data-kerkere-icon>جزئیات بیشتر</div>

	<div class="ShowTerminalFieldDetail" data-kerkere-content='hide'>
		<div class="example">
			<div class="f">
				<div class="c4 s12">
					<div class="mRa5">
						<?php IserialNumber(); ?>
						<?php IhardwareBrand(); ?>
						<?php IhardwareModel(); ?>
						<?php IaccessAddress(); ?>
						<?php IaccessPort(); ?>
						<?php IcallbackAddress(); ?>
						<?php IcallbackPort(); ?>

					</div>
				</div>

				<div class="c4 s12">
					<div class="mRa5">

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



<?php function Isequence() {?>
<label for="i_sequence">sequence <span class="mLa10">شماره یکتای جزئیات درخواست</span></label>
<div class="input">
	<input type="text" name="sequence" value="<?php echo \dash\data::dataRowTerminal_sequence(); ?>">
</div>
<?php } //endfunction ?>


<?php function IterminalNumber() {?>
<label for="i_terminalNumber">terminalNumber <span class="mLa10">شماره پایانه</span></label>
<div class="input">
	<input type="text" name="terminalNumber" value="<?php echo \dash\data::dataRowTerminal_terminalNumber(); ?>">
</div>
<?php } //endfunction ?>


<?php function IterminalType() {?>
<label for="i_terminalType">terminalType <span class="mLa10">نوع پایانه</span></label>
<div class="input">
	<input type="text" name="terminalType" value="<?php echo \dash\data::dataRowTerminal_terminalType(); ?>">
</div>
<?php } //endfunction ?>


<?php function IserialNumber() {?>
<label for="i_serialNumber">serialNumber <span class="mLa10">سریال سخت افزاری پایانه</span></label>
<div class="input">
	<input type="text" name="serialNumber" value="<?php echo \dash\data::dataRowTerminal_serialNumber(); ?>">
</div>
<?php } //endfunction ?>


<?php function IsetupDate() {?>
<label for="i_setupDate">setupDate <span class="mLa10">تاریخ فعال سازی</span></label>
<div class="input">
	<input type="text" name="setupDate" value="<?php echo \dash\data::dataRowTerminal_setupDate(); ?>">
</div>
<?php } //endfunction ?>


<?php function IhardwareBrand() {?>
<label for="i_hardwareBrand">hardwareBrand <span class="mLa10">برند سخت‌افزاری پایانه</span></label>
<div class="input">
	<input type="text" name="hardwareBrand" value="<?php echo \dash\data::dataRowTerminal_hardwareBrand(); ?>">
</div>
<?php } //endfunction ?>


<?php function IhardwareModel() {?>
<label for="i_hardwareModel">hardwareModel <span class="mLa10">مدل سخت‌افزار پایانه</span></label>
<div class="input">
	<input type="text" name="hardwareModel" value="<?php echo \dash\data::dataRowTerminal_hardwareModel(); ?>">
</div>
<?php } //endfunction ?>


<?php function IaccessAddress() {?>
<label for="i_accessAddress">accessAddress <span class="mLa10">آدرس پایگاه اینترنتی</span></label>
<div class="input">
	<input type="text" name="accessAddress" value="<?php echo \dash\data::dataRowTerminal_accessAddress(); ?>">
</div>
<?php } //endfunction ?>


<?php function IaccessPort() {?>
<label for="i_accessPort">accessPort <span class="mLa10">پورت پایگاه اینترنتی استفاده کننده از درگاه اینترنتی</span></label>
<div class="input">
	<input type="text" name="accessPort" value="<?php echo \dash\data::dataRowTerminal_accessPort(); ?>">
</div>
<?php } //endfunction ?>


<?php function IcallbackAddress() {?>
<label for="i_callbackAddress">callbackAddress <span class="mLa10">آدرس بازگشت درگاه اینترنتی</span></label>
<div class="input">
	<input type="text" name="callbackAddress" value="<?php echo \dash\data::dataRowTerminal_callbackAddress(); ?>">
</div>
<?php } //endfunction ?>


<?php function IcallbackPort() {?>
<label for="i_callbackPort">callbackPort <span class="mLa10">پورت بازگشت درگاه اینترنتی</span></label>
<div class="input">
	<input type="text" name="callbackPort" value="<?php echo \dash\data::dataRowTerminal_callbackPort(); ?>">
</div>
<?php } //endfunction ?>

