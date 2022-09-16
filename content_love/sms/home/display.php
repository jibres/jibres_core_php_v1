<section class="f">
    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() . '/datalist' ?>" class="stat">
            <h3><?php echo T_("SMS List"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_totalRows()); ?></div>
        </a>
    </div>


    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() . '/sending'; ?>" class="stat">
            <h3><?php echo T_("Sending List"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_refundGuarantee()); ?></div>
        </a>
    </div>

    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() . '/sending?manual=run'; ?>" class="stat">
            <h3><?php echo T_("Run manually"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_refund()); ?></div>
        </a>
    </div>

    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() . '/charge'; ?>" class="stat">
            <h3><?php echo T_("Charge list"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_active()); ?></div>
        </a>
    </div>
    <div class="c3 s12">
        <a href="<?php echo \dash\url::current() . '/charge'; ?>" class="stat">
            <h3><?php echo T_("Total charge"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_active()); ?></div>

        </a>
    </div>
</section>

<section class="f">
    <div class="c9 s12 pRa10">
        <div id="chartdivplanadmin" class="box chart x210" data-hint1='Plan'
             data-abc='management/planadmin'></div>
        <div class="hidden">
            <div id="chartplanadmintitle"><?php echo T_("Plan register per date"); ?></div>
            <div id="chartdivplanadmincategory"><?php echo a(\dash\data::dashboardDetail_chart(), 'categories') ?></div>
            <div id="chartdivplanadminseries"><?php echo a(\dash\data::dashboardDetail_chart(), 'series') ?></div>
        </div>
    </div>
    <div class="c3 s12">
        <a href="<?php echo \dash\url::current() . '/charge'; ?>" class="stat">
            <h3><?php echo T_("Total Spent"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_yearlyCount()); ?></div>
        </a>
        <a href="<?php echo \dash\url::current() . '/charge'; ?>" class="stat">
            <h3><?php echo T_("Count business Have charge"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_monthlyCount()); ?></div>
        </a>
    </div>
</section>


<section class="f">
    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() ?>" class="stat">
            <h3><?php echo T_("Current Jibres SMS Panel Charge"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(rand()); ?></div>
        </a>
    </div>
    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() ?>" class="stat">
            <h3><?php echo T_("Current Business SMS Panel Charge"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(rand()); ?></div>
        </a>
    </div>
</section>


All sms group by status
<section class="f">
    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() ?>" class="stat">
            <h3><?php echo T_("Sending"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(rand()); ?></div>
        </a>
    </div>
    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() ?>" class="stat">
            <h3><?php echo T_("Current Business SMS Panel Charge"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(rand()); ?></div>
        </a>
    </div>
</section>