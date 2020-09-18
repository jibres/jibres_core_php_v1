<div class="row">
	<div class="c-xs-12 c-sm-12 c-md-4">
		<?php require_once(root. 'content_a/form/itemLink.php');
		 ?>
	</div>
	<div class="c-xs-12 c-sm-12 c-md-8">



<form method="post" autocomplete="off" id="form1">
	<div class="box">
		<div class="pad">
			<label for="ititle"><?php echo T_("Title") ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
			<div class="input">
				<input type="text" id="ititle" name="title" value="<?php echo \dash\data::dataRow_title(); ?>">
			</div>

			<div class="mB10">
				<label for="desc"><?php echo T_("Description") ?></label>
				<textarea name="desc" data-editor class="txt" rows="3" id="desc" placeholder="<?php echo T_("Description") ?>"><?php echo \dash\data::dataRow_desc(); ?></textarea>
			</div>

			<div class="mB10">
				<div data-uploader data-name='file' data-final='#finalImagefile1'>
					<input type="file" accept="image/*" id="file1">
					<label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
					<label for="file1"><img id="finalImagefile1" <?php if(\dash\data::dataRow_file()) {?>src="<?php echo \dash\data::dataRow_file(); ?>" <?php } //endif ?> alt="<?php echo T_("File") ?>"></label>
				</div>
			</div>
		</div>
	</div>
</form>
	</div>
</div>
