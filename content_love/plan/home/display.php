<section class="f">
    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() . '/datalist' ?>" class="stat">
            <h3><?php echo T_("Plan history list"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_totalRows()); ?></div>
        </a>
    </div>


    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() . '/datalist?reason=refund+guarantee'; ?>" class="stat">
            <h3><?php echo T_("Refund + Guarantee"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_refundGuarantee()); ?></div>
        </a>
    </div>

    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() . '/datalist?reason=refund'; ?>" class="stat">
            <h3><?php echo T_("Refund"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_refund()); ?></div>
        </a>
    </div>

    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() . '/datalist?status=active'; ?>" class="stat">
            <h3><?php echo T_("Active plan"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_active()); ?></div>
        </a>
    </div>
    <div class="c3 s12">
        <a href="<?php echo \dash\url::current() . '/add'; ?>" class="stat">

            <div class="val"><?php echo T_("Add plan to business") ?></div>
        </a>
    </div>
</section>

<section class="f">
    <div class="c9 s12 pRa10">
        <div id="chartdivactionday" class="box chart x210" data-hint1='Action lasy 30 days per date'
             data-abc='management/domainhomepage'></div>
    </div>
    <div class="c3 s12">
        <a href="<?php echo \dash\url::current() . '/datalist?periodtype=yearly'; ?>" class="stat">
            <h3><?php echo T_("Yearly count"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_yearlyCount()); ?></div>
        </a>
        <a href="<?php echo \dash\url::current() . '/datalist?periodtype=monthly'; ?>" class="stat">
            <h3><?php echo T_("Monthly count"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_monthlyCount()); ?></div>
        </a>
    </div>
</section>

<?php
$groupByStatus = \dash\data::dashboardDetail_groupByStatus();
if(!is_array($groupByStatus))
{
	$groupByStatus = [];
}
?>

<section class="f">
	<?php foreach ($groupByStatus as $plan => $statusCount): ?>
        <div class="c pRa10">
            <a href="<?php echo \dash\url::current() . '/datalist?plan=' . $plan; ?>" class="stat">
                <h3><?php echo T_(ucfirst(strval($plan))); ?></h3>
                <div class="val">

                <span title="<?php echo T_("Active"); ?>">
                    <?php echo \dash\fit::stats($statusCount['active']); ?>
                </span>
                    /
                    <span class="text-gray-300" title="<?php echo T_("Deactive"); ?>">
                    <?php echo \dash\fit::stats($statusCount['deactive']); ?>
                </span>

                </div>
            </a>
        </div>
	<?php endforeach; ?>
</section>
