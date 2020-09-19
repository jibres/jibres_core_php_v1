<div class="jFooter201" data-footer=201>
	<div class="avand-xl">

		<div class="top">
			<div class="row align-end">
				<div class="c-xs-12 c-sm-12 c-md">
					<h3><a href="<?php echo \dash\url::kingdom(); ?>" target="_blank"><?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'title'); ?></a></h3>
					<p><?php echo \dash\get::index($website, 'footer', 'maintext', 'text') ?></p>
				</div>
				<div class="c-xs-12 c-sm-12 c-md-auto">
					<div class="certifications txtRa">
						<a class="cert enamad" href="">
							<img src="<?php echo \dash\url::cdn(); ?>/img/business/cert/enamad1-org.png" alt="اینماد  <?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'title'); ?>">
						</a>
						<div class="cert samandehi" id="samandehiCert" data-open="https://logo.samandehi.ir/Verify.aspx?id=162977&p=rfthgvkauiwkpfvljyoejyoe">
							<img src="<?php echo \dash\url::cdn(); ?>/img/business/cert/samandehi-review.png" alt="مجوز ساماندهی  <?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'title'); ?>">
						</div>

					</div>
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