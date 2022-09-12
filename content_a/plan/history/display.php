<nav class="items">
    <ul>
		<?php foreach (\dash\data::dataTable() as $key => $value) { ?>
            <li>
                <div class="f align-center">

                    <div class="key">
						<?php
						echo T_(ucfirst(strval(a($value, 'plan'))));
						if(a($value, 'periodtype'))
						{

							echo ' / ';
							echo T_(ucfirst(strval(a($value, 'periodtype'))));
						}

						if(a($value, 'expirydate') && a($value, 'status') === 'active')
						{

							echo ' / ';
                            echo '<span class="ltr compact">';
                            {
                                echo T_("Expire at");
                                echo ' ';
								echo \dash\fit::date(a($value, 'expirydate'), 'l j F Y');
							}
							echo '</span>';
						}


						?>
                    </div>

                    <div class="spay-32-<?php echo a($value, 'payment'); ?> key cauto"></div>
                    <div class="key font-bold ltr"><?php if(isset($value['plus']) && $value['plus']) { ?><b>
                            +<?php echo \dash\fit::price($value['plus']); ?></b><?php } ?><?php if(isset($value['minus']) && $value['minus']) { ?>
                            <b>-<?php echo \dash\fit::price($value['minus']); ?></b><?php } ?></div>

                    <div class="value datetime s0"><?php echo \dash\fit::date_time(a($value, 'startdate')); ?></div>
                    <div class="go detail s0"></div>
                </div>
            </li>
		<?php } //endfor ?>
    </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>
