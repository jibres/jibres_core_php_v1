<div class="row">
	<div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root. 'content_a/form/itemLink.php');?>
	</div>
	<div class="c-xs-12 c-sm-12 c-lg-8">

		<div class="box">
			<div class="body">
				<div class="txtB">
					<?php echo \dash\data::dataRow_title(); ?>
				</div>
			</div>
		</div>

		<form method="post" autocomplete="off" id="form1">
			<div class="box">
				<header><h2><?php echo T_("Add new item") ?></h2></header>
				<div class="body">
					<label><?php echo T_("Title") ?></label>
					<div class="input">
						<input type="text" name="new_title" placeholder="<?php echo T_("Title") ?>" value="<?php echo \dash\data::dataRowd_title(); ?>">
					</div>
					<label><?php echo T_("Type") ?></label>
					<select name="new_type" class="select22">
						<?php foreach (\dash\data::itemType() as $type_key => $type_value) {?>
							<optgroup label="<?php echo \dash\get::index($type_value, 'title'); ?>">
								<?php if(isset($type_value['list']) && is_array($type_value['list'])) { foreach ($type_value['list'] as $k => $v) {?>
									<option value="<?php echo $v['key'] ?>"><?php echo $v['title']; ?></option>
								<?php } /*endfor*/  } //endif?>
							</optgroup>
						<?php } //endif ?>

					</select>

					<div class="switch1 mT10">
						<input type="checkbox" name="new_require" id="check1">
						<label for="check1"><?php echo T_("Required"); ?></label>
						<label for="check1"><?php echo T_("Required"); ?></label>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
