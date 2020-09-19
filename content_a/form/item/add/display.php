<div class="avand-md">



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
					<input type="text" name="new_title" placeholder="<?php echo T_("Title") ?>" value="<?php echo \dash\data::dataRowd_title(); ?>" <?php \dash\layout\autofocus::html() ?>>
				</div>
				<div class="switch1 mT10">
					<input type="checkbox" name="new_require" id="check1">
					<label for="check1"><?php echo T_("Required"); ?></label>
					<label for="check1"><?php echo T_("Is required?"); ?></label>
				</div>

				<?php $i =0; $first = true; foreach (\dash\data::itemType() as $type_key => $type_value) { $i++;?>
					<div class="msg minimal info2" data-kerkere='.showList<?php echo $i; ?>' <?php if($first) { echo "data-kerkere-icon='open'"; }else{ echo "data-kerkere-icon='close'"; } //endif ?> ><?php echo \dash\get::index($type_value, 'title'); ?></div>
					<div class="showList<?php echo $i; ?>" <?php if($first) { $first = false;}else{ ?> data-kerkere-content='hide' <?php } //endif ?>>

						<div class="row">
							<?php if(isset($type_value['list']) && is_array($type_value['list'])) { foreach ($type_value['list'] as $k => $v) {?>

								<div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
									<div class="radio4">
										<input  id="<?php echo $v['key'] ?>" type="radio" name="new_type" value="<?php echo $v['key'] ?>" >
										<label for="<?php echo $v['key'] ?>">
											<div>
												<div class="title"><?php echo $v['title']; ?></div>
											</div>
										</label>
									</div>
								</div>
							<?php } /*endfor*/  } //endif?>
						</div>
					</div>

				<?php } //endfor ?>

			</div>
		</div>
	</form>
</div>
