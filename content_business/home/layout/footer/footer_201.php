<div class="jFooter201" data-footer=201>
	<div class="avand-xl">

		<div class="top">
			<div class="row">
				<div class="c-xs-12 c-sm-12 c-md-8">
					<h3><a href="<?php echo \dash\url::kingdom(); ?>" target="_blank"><?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'title'); ?></a></h3>
					<p><?php echo \dash\get::index($website, 'footer', 'maintext', 'text') ?></p>
				</div>
				<div class="c-xs-12 c-sm-12 c-md-auto os">
					<a class="button" href="">Sign Up Free</a>
				</div>
			</div>
		</div>
		<hr>
		<nav class="mid">
			<div class="f">
				<div class="c3">
					<h4><?php echo "Company" ?></h4>
					<ul>
						<li><a href="">About</a></li>
						<li><a href="">Career</a></li>
						<li><a href="">Pricing</a></li>
					</ul>
				</div>

				<div class="c3">
					<h4><?php echo "Products" ?></h4>
					<ul>
						<li><a href="">About</a></li>
						<li><a href="">Career</a></li>
						<li><a href="">Pricing</a></li>
					</ul>
				</div>

				<div class="c3">
					<h4><?php echo "Use Cases" ?></h4>
					<ul>
						<li><a href="">About</a></li>
						<li><a href="">Career</a></li>
						<li><a href="">Pricing</a></li>
					</ul>
				</div>

				<div class="c3">
					<h4><?php echo "Resources" ?></h4>
					<ul>
						<li><a href="">About</a></li>
						<li><a href="">Career</a></li>
						<li><a href="">Pricing</a></li>
					</ul>
				</div>

			</div>
		</nav>
		<hr>
		<div class="bottom ltr">
			<p>&copy; <?php echo \dash\datetime::fit(null, 'Y'). '. '. T_('All rights reserved.'); ?> <a href="/privacy">Privacy</a> and <a href="/terms">Terms</a>.</p>
		</div>
	</div>
</div>