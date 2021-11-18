<div class="row">
	<div class="c-xs-12 c-sm-12 c-md-4">
		<?php require_once(root. 'content_a/form/itemLink.php');
		 ?>
	</div>
	<div class="c-xs-12 c-sm-12 c-md-8">


	<div class="box">
		<div class="body">
			<div class="font-bold">
				<?php echo \dash\data::dataRow_title(); ?>
			</div>
		</div>
	</div>


	<?php if(\dash\data::formItems()) {?>
		<h3><?php echo T_("Items") ?></h3>
			<nav class="items long">
			 <ul>
			<?php foreach (\dash\data::formItems() as $key => $value) { ?>
				      <li><a class="f" href="<?php echo \dash\url::this(). '/item?id='. \dash\request::get('id'). '&item='. a($value, 'id') ?>"><div class="key">
			      	<?php if(a($value, 'require')) {?><span class="fc-red">*</span><?php } ?>
			      	<?php echo a($value, 'title'); ?></div><div class="value"><?php echo a($value, 'type_detail', 'title'); ?></div><div class="go"></div></a></li>

			<?php } //endif ?>
			 </ul>
			</nav>
	<?php }// endif ?>
	</div>
</div>
