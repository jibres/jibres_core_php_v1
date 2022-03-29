<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<form class="box" method="post" autocomplete="off">
	<div class="body">
		<div class="row mb-2">
			<div class="c-xs-12 c-sm-6">
				<div class="radio3">
					<input type="radio" name="accounttype" value="real" id="accounttypereal" <?php if(\dash\data::dataRowMember_accounttype() === 'real') { echo 'checked'; } ?>>
					<label for="accounttypereal"><?php echo T_("Real account") ?></label>
				</div>
			</div>
			<div class="c-xs-12 c-sm-6">
				<div class="radio3">
					<input type="radio" name="accounttype" value="legal" id="accounttypelegal" <?php if(\dash\data::dataRowMember_accounttype() === 'legal') { echo 'checked'; } ?>>
					<label for="accounttypelegal"><?php echo T_("Legal account") ?></label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="c-xs-12 c-sm-6 c-md-4">
				<label for="icompanyeconomiccode"><?php echo T_("Economic code"); ?></label>
				<div class="input">
					<input type="text" name="companyeconomiccode" id="icompanyeconomiccode" value="<?php echo \dash\data::dataRowMember_companyeconomiccode(); ?>" data-format='int' maxlength="12">
				</div>
			</div>
			<div class="c-xs-12 c-sm-6 c-md-4">
				<label for="inationalcode"><?php echo T_("Nationalcode"); ?> <small data-response='accounttype' data-response-where='legal' <?php if(\dash\data::dataRowMember_accounttype() !== 'legal') { echo 'data-response-hide'; } ?>><?php echo T_("CEO"); ?></small></label>
				<div class="input">
					<input type="text" name="nationalcode" id="inationalcode" value="<?php echo \dash\data::dataRowMember_nationalcode(); ?>" data-format='nationalCode'>
				</div>
			</div>
			<div class="c-xs-12 c-sm-6 c-md-4">
				<label for="iwebsite"><?php echo T_("Website"); ?></label>
				<div class="input">
					<input type="url" name="website" id="iwebsite" value="<?php echo \dash\data::dataRowMember_website(); ?>" maxlength='63'>
				</div>
			</div>
		</div>
		<div data-response='accounttype' data-response-where='legal' <?php if(\dash\data::dataRowMember_accounttype() !== 'legal') { echo 'data-response-hide'; } ?>>
			<div class="row">
				<div class="c-xs-12 c-sm-4">
					<label for="icompanyname"><?php echo T_("Company name"); ?></label>
					<div class="input">
						<input type="text" name="companyname" id="icompanyname" value="<?php echo \dash\data::dataRowMember_companyname(); ?>" maxlength="60">
					</div>
				</div>
				<div class="c-xs-12 c-sm-4">
					<label for="icompanyregisternumber"><?php echo T_("Company register number"); ?></label>
					<div class="input">
						<input type="text" name="companyregisternumber" id="icompanyregisternumber" value="<?php echo \dash\data::dataRowMember_companyregisternumber(); ?>" data-format='int' maxlength="10">
					</div>
				</div>
				<div class="c-xs-12 c-sm-4">
					<label for="icompanynationalid"><?php echo T_("Company national id"); ?></label>
					<div class="input">
						<input type="text" name="companynationalid" id="icompanynationalid" value="<?php echo \dash\data::dataRowMember_companynationalid(); ?>" data-format='int' maxlength="11">
					</div>
				</div>
			</div>
		</div>
		<?php if(\dash\data::haveCoding()) {?>
			<div class="">
				<div class="row">
					<div class="c-auto">
						<label for="accounting_detail_id"><?php echo T_("Details in accounting topics to display and record quarterly reports"); ?></label>
					</div>
					<div class="c"></div>
					<div class="c-auto"><a target="_blank" class="link fs08" href="<?php echo \dash\url::kingdom(). '/a/accounting/coding/add?type=details' ?>"><i class="sf-external-link"></i> <?php echo T_("Add new accounting details") ?></a></div>
				</div>
				<select class="select22" name="accounting_detail_id"  data-placeholder='<?php echo T_("Accounting detail") ?>'>
					<option value="0"><?php echo T_("None") ?></option>
					<?php foreach (\dash\data::detailsList() as $key => $value){ if(in_array(substr(a($value, 'code'), 0, 2), ['52', '51', '42', '41'])) {/*ok*/}else{continue;} ?>
						<option value="<?php echo a($value, 'id') ?>" <?php if(a(\dash\data::dataRowMember(), 'accounting_detail_id') === a($value, 'id')){ echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
					<?php } // endfor ?>
				</select>
			</div>
		<?php } //endif ?>
	</div>
	<footer class="txtRa">
		<button class="btn-primary" name="btn" value="add"><?php echo T_("Save"); ?></button>
	</footer>
</form>