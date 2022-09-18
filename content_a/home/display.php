<?php $dashboardData = \dash\data::dashboardData(); ?>

<div class="row">
    <div class="c-xs-12 c-sm-12 c-md-9">


        <div class="text-sm">
			<?php if(a($dashboardData, 'notSentSMSCount')) { ?>
                <a href="<?php echo \dash\url::kingdom() . '/crm/sms/datalist?status=moneylow' ?>">
                    <div class="alert-warning mb-3 font-bold">
						<?php echo T_("You have :val not sent SMS", ['val' => \dash\fit::number(a($dashboardData, 'notSentSMSCount'))]) ?>
                    </div>
                </a>
			<?php } //endif ?>
			<?php if(a($dashboardData, 'new_order')) { ?>
                <a href="<?php echo \dash\url::here() . '/order/unprocessed' ?>">
                    <div class="alert-success mb-3 font-bold">
						<?php echo T_("You have :val Unprocessed order", ['val' => \dash\fit::number(a($dashboardData, 'new_order'))]) ?>
                    </div>
                </a>
			<?php } //endif ?>
			<?php if(a($dashboardData, 'new_ticket')) { ?>
                <a href="<?php echo \dash\url::kingdom() . '/crm/ticket/datalist?status=awaiting' ?>">
                    <div class="alert-success mb-3 font-bold">
						<?php echo T_("You have :val Unanswered ticket", ['val' => \dash\fit::number(a($dashboardData, 'new_ticket'))]) ?>
                    </div>
                </a>
			<?php } //endif ?>
			<?php if(a($dashboardData, 'new_comment')) { ?>
                <a href="<?php echo \dash\url::kingdom() . '/cms/comments?status=awaiting' ?>">
                    <div class="alert-success mb-3 font-bold">
						<?php echo T_("You have :val awaiting comment", ['val' => \dash\fit::number(a($dashboardData, 'new_comment'))]) ?>
                    </div>
                </a>
			<?php } //endif ?>
			<?php if(a($dashboardData, 'notif_count')) { ?>
                <a href="<?php echo \dash\url::kingdom() . '/crm/notification/me' ?>">
                    <div class="alert-success mb-3 font-bold">
						<?php echo T_("You have :val new message!", ['val' => \dash\fit::number(a($dashboardData, 'notif_count'))]) ?>
                    </div>
                </a>
			<?php } //endif ?>
			<?php if(a($dashboardData, 'new_form_answer')) { ?>
				<?php foreach (a($dashboardData, 'new_form_answer') as $key => $value) { ?>
                    <a href="<?php echo \dash\url::kingdom() . '/a/form/answer?id=' . a($value, 'id') ?>">
                        <div class="alert-success mb-3 font-bold">
							<?php echo T_("You have :val not reviewed answer in :form", [
								'val'  => \dash\fit::number(a($value, 'count_need_review')),
								'form' => a($value, 'title'),
							]) ?>
                        </div>
                    </a>
				<?php } //endif ?>
			<?php } //endif ?>
        </div>
		<?php if(\dash\permission::check('_group_products')) { ?>
            <div id="chartdiv" class="box chart x400" data-abc='a/homepage'></div>
		<?php } //endif ?>
        <div class="hide">
            <div id="chartcategory"><?php echo a(\dash\data::dashboardData(), 'chart', 'categories'); ?></div>
            <div id="chartsum"><?php echo a(\dash\data::dashboardData(), 'chart', 'sum'); ?></div>
            <div id="chartcount"><?php echo a(\dash\data::dashboardData(), 'chart', 'count'); ?></div>
            <div id="charttitle"><?php echo T_("Sum factor price and count of it group by hours"); ?></div>
            <div id="charttitlesum"><?php echo T_("Sum price"); ?></div>
            <div id="charttitlecount"><?php echo T_("Count"); ?></div>
            <div id="charttitleunit"><?php echo \lib\store::currency(); ?></div>
        </div>
    </div>


    <div class="c-xs-12 c-sm-12 c-md-3">
		<?php if(\dash\data::myPlanDetail_plan() === 'free') : ?>
            <div class=" rounded-xl">

                <a href="<?php echo \dash\url::here() . '/plan/choose'; ?>" class="stat">
                    <h3><?php echo T_("Your current plan"); ?></h3>
                    <div class="val"><?php echo \dash\data::myPlanDetail_planTitle(); ?> </div>
                </a>

            </div>
		<?php else: ?>
            <a href="<?php echo \dash\url::here() . '/plan'; ?>" class="circularChartBox" title="">
				<?php $myPercent = intval(\dash\data::myPlanDetail_daysRemainPercent());
				include core . '/layout/elements/circularChart.php'; ?>
                <h3><?php echo \dash\data::myPlanDetail_planTitle(); ?></h3>
                <p>
					<?php echo T_(":val days left to expire paln", ['val' => \dash\data::myPlanDetail_daysLeft()]); ?>
                </p>
            </a>
		<?php endif; ?>
        <div class=" rounded-xl">
            <a href="<?php echo \dash\url::here() . '/plan'; ?>" class="stat">
                <h3><?php echo T_("Your SMS charge"); ?></h3>
                <div class="val"><?php echo \dash\fit::number(\dash\data::smsChargeDetail_charge()); ?>
                    <small><?php echo \dash\data::smsChargeDetail_currency(); ?></small></div>
            </a>
        </div>


		<?php if(\dash\data::businessCheckLisst_visible()) { ?>
            <section class="circularChartBox">
				<?php $myPercent = intval(\dash\data::businessCheckLisst_percent());
				include core . '/layout/elements/circularChart.php'; ?>
                <h3><?php echo T_("Business setup"); ?></h3>
            </section>

            <nav class="items long">
                <ul>
					<?php foreach (\dash\data::businessCheckLisst_list() as $key => $value) { ?>
                        <li>
                            <a class="f" href="<?php echo a($value, 'link') ?>">
                                <div class="key"><?php echo a($value, 'title'); ?></div>
                                <div class="go <?php if(a($value, 'ok'))
								{
									echo 'check ok';
								}
								else
								{
									echo 'times nok';
								} ?>"></div>
                            </a>
                        </li>
					<?php } //endfor ?>
                </ul>
            </nav>
		<?php } ?>
    </div>
</div>
