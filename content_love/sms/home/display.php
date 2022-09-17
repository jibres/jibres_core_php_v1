<section class="f">
    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() . '/datalist' ?>" class="stat">
            <h3><?php echo T_("SMS List"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_countall()); ?></div>
        </a>
    </div>



    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() . '/sending'; ?>" class="stat">
            <h3><?php echo T_("Sending List"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_countallsending()); ?></div>
        </a>
    </div>


    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() . '/charge'; ?>" class="stat">
            <h3><?php echo T_("Charge list"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_countallcharge()); ?></div>
        </a>
    </div>
    <div class="c3 s12">
        <a href="<?php echo \dash\url::current() . '/charge'; ?>" class="stat">
            <h3><?php echo T_("Total charge"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(\dash\data::dashboardDetail_totalcharge()); ?></div>

        </a>
    </div>
</section>

<section class="f">
    <div class="c9 s12 pRa10">
        <div id="chartdivplanadmin" class="box chart x210" data-hint1='Plan'
             data-abc='management/planadmin'></div>
        <div class="hidden">
            <div id="chartplanadmintitle"><?php echo T_("Sms status per date"); ?></div>
            <div id="chartdivplanadmincategory"><?php echo a(\dash\data::dashboardDetail_chart(), 'categories') ?></div>
            <div id="chartdivplanadminseries"><?php echo a(\dash\data::dashboardDetail_chart(), 'series') ?></div>
        </div>
    </div>
    <div class="c3 s12">
        <a href="<?php echo \dash\url::current() . '/charge'; ?>" class="stat">
            <h3><?php echo T_("Total Spent"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_totalspent()); ?></div>
        </a>
        <a href="<?php echo \dash\url::current() . '/charge'; ?>" class="stat">
            <h3><?php echo T_("Count business Have charge"); ?></h3>
            <div class="val"><?php echo \dash\fit::stats(\dash\data::dashboardDetail_countbusinesscharge()); ?></div>
        </a>
    </div>
</section>


<section class="f">
    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() ?>" class="stat">
            <h3><?php echo T_("Current Jibres SMS Panel Charge"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(\dash\data::dashboardDetail_kavenegarjibressmspanelcharge()); ?></div>
        </a>
    </div>
    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() ?>" class="stat">
            <h3><?php echo T_("Current Business SMS Panel Charge"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(\dash\data::dashboardDetail_kavenegarbusinessmspanelcharge()); ?></div>
        </a>
    </div>
</section>

<section class="f">
    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() ?>" class="stat">
            <h3><?php echo T_("Average charge"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(\dash\data::dashboardDetail_avgcharge()); ?></div>
        </a>
    </div>
    <div class="c pRa10">
        <a href="<?php echo \dash\url::current() ?>" class="stat">
            <h3><?php echo T_("Total real spent"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(\dash\data::dashboardDetail_totalrealspent()); ?></div>
        </a>
    </div>
</section>






<?php if(($smsPerStatus = \dash\data::dashboardDetail_smsperstatus()) && is_array($smsPerStatus)) : ?>
    <section class="f">
		<?php foreach ($smsPerStatus as $value) : ?>
            <div class="c pRa10">
                <a href="<?php echo \dash\url::current(). '/datalist?status='. $value['status'] ?>" class="stat">
                    <h3><?php echo T_(ucfirst(strval($value['status']))); ?></h3>
                    <div class="val"><?php echo \dash\fit::number($value['count']); ?></div>
                </a>
            </div>
		<?php endforeach; ?>
    </section>
<?php endif; ?>