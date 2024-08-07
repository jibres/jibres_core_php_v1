<?php $dataRow = \dash\data::dataRow(); ?>
<div class="avand-md">
	<p class="msg text-sm"><?php echo T_("To optimize your images and increase your SEO score, we store uploaded images in different sizes in webp format so that you can use it anywhere with the required size.") ?></p>
	<div class="row">
		<?php
			foreach (\dash\utility\image::responsive_image_size() as $size) {
			$myPath = \lib\filepath::fix(str_replace('.'. \dash\data::dataRow_ext(), '-w'. $size. '.webp', \dash\data::dataRow_path()));
		?>
			<div class="c-xs-12 c-sm-6 c-md-4">
				<div class="vcard m-2">
					<img alt="<?php echo T_("Image") ?>" src="<?php echo $myPath ?>">
        	<div class="content">
            <div class="header">
            	<a href="<?php echo $myPath ?>" target="_blank"><i class="sf-link-external"></i> <?php echo T_("Width"). ' '. \dash\fit::text($size); ?></a>
            </div>
          </div>
          <footer></footer>
				</div>
    		</div>
		<?php } //endi ?>
	</div>
</div>
