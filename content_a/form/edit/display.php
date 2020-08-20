<div class="avand-md">
	<form method="post" autocomplete="off">
		<div class="box">
			<div class="body">
				<label for="title"><?php echo T_("Title") ?></label>
				<div class="input">
					<input type="text" name="title" value="<?php echo \dash\data::dataRow_title(); ?>">
					<div data-kerkere='.showAdvanceOption' class="addon"><i class="sf-plus"></i> <span><?php echo T_("Advance option") ?></span></div>
				</div>

				<div class="showAdvanceOption" data-kerkere-content='hide'>
					<label for="slug"><?php echo T_("Slug") ?></label>
					<div class="input">
						<input type="text" name="slug" value="<?php echo \dash\data::dataRow_slug(); ?>">
					</div>
				</div>
			</div>
			<footer class="txtRa">
				<button class="btn master"><?php if(\dash\data::editMode()) {echo T_("Edit"); }else{ echo T_("Add");} ?></button>
			</footer>
		</div>
	</form>
</div>