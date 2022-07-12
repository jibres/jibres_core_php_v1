<div class="jibresBanner">


 <div class="avand impact text-center" data-text-style="t1">
 	<div class="grid grid-cols-1 md:grid-cols-2 items-center gap-2 md:gap-4">
 		<img class="block" src="<?php echo \dash\url::cdn(); ?>/img/cover/Jibres-cover-portfolio-1.jpg" alt="<?php echo T_('Jibres Portfolio'); ?>">
		<div class="text-xl leading-relaxed">
			<p>
				<span><?php echo T_("Jibres has provided infrastructure for many businesses."); ?></span>
				<span><?php echo T_("The trust of our dear customers in Jibres is very valuable to us."); ?></span>
			</p>
			<h2><?php echo T_("You can have your own website quickly and for free."); ?></h2>
			<a class="btn-outline-primary" href=""><?php echo T_("SIGN UP FREE"); ?></a>
		</div>
 	</div>
 </div>
</div>


 <div class="m-auto max-w-screen-lg w-full px-2 sm:px-4 lg:px-5 relative py-5">
	<div class="grid grid-cols-1 md:grid-cols-2 items-center gap-2">

<?php foreach (\dash\data::dataTable() as $key => $value) { ?>		
		<figure class="my-4">
			<a class="hover:shadow-lg shadow transition block rounded-lg" target="_blank" data-fancybox="portfolioPreview" data-caption="<?php echo a($value, 'title') ?>" href="<?php echo \lib\filepath::fix(a($value, 'img_full')) ?>">
				<img class="aspect-video bg-white rounded-lg" loading="lazy" src="<?php echo \lib\filepath::fix(a($value, 'img')) ?>" alt="<?php echo a($value, 'title') ?>">
			</a>
			<figcaption class="items long mt-2">
				<ul class="">
					<li>
						<a class="item f" href="<?php echo a($value, 'url') ?>" target="_blank" rel="nofollow noopener">
						<div class="key"><?php echo a($value, 'title') ?></div>
						<div class="value"><?php echo a($value, 'display_url') ?></div>
						<div class="go external"></div>
						</a>
					</li>
				</ul>
			</figcaption>
		</figure>
<?php } // endfor ?>

	</div>
 </div>
