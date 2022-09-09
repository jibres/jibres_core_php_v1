<div class="f">
    <?php if (\dash\permission::supervisor()) { ?>
        <div class="c12 s6">
            <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::sitelang(); ?>/sudo'>
                <div class="statistic pink">
                    <div class="value"><i class="text-3xl sf-heartbeat"></i></div>
                    <div class="label"><?php echo T_("Supervisor Panel"); ?></div>
                </div>
            </a>
        </div>
    <?php } ?>

    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::here(); ?>/store'>
            <div class="statistic green">
                <div class="value"><i class="text-3xl sf-shop"></i></div>
                <div class="label"><?php echo T_("Store list"); ?></div>
            </div>
        </a>
    </div>

    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::here(); ?>/business'>
            <div class="statistic blue">
                <div class="value"><i class="text-3xl sf-analytics-chart-graph"></i></div>
                <div class="label"><?php echo T_("Store analytics"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::here(); ?>/domain'>
            <div class="statistic blue">
                <div class="value"><i class="text-3xl sf-list-ul"></i></div>
                <div class="label"><?php echo T_("Domains"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::here(); ?>/business/domain'>
            <div class="statistic blue">
                <div class="value"><i class="text-3xl sf-globe"></i></div>
                <div class="label"><?php echo T_("Business domains"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::here(); ?>/notiflog'>
            <div class="statistic red">
                <div class="value"><i class="text-3xl sf-camera-surveillance"></i></div>
                <div class="label"><?php echo T_("Notif log"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::this(); ?>/log'>
            <div class="statistic blue">
                <div class="value"><i class="text-3xl sf-database"></i></div>
                <div class="label"><?php echo T_("Logs"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::this(); ?>/sms'>
            <div class="statistic blue">
                <div class="value"><i class="text-3xl sf-envelope"></i></div>
                <div class="label"><?php echo T_("Sms Log"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::this(); ?>/telegram/datalist'>
            <div class="statistic blue">
                <div class="value"><i class="text-3xl sf-paper-plane"></i></div>
                <div class="label"><?php echo T_("Telegram Log"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::this(); ?>/email'>
            <div class="statistic purple">
                <div class="value"><i class="text-3xl sf-envelope"></i></div>
                <div class="label"><?php echo T_("Email"); ?></div>
            </div>
        </a>
    </div>

    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::this(); ?>/apilog/twitter'>
            <div class="statistic blue">
                <div class="value"><i class="text-3xl sf-plug"></i></div>
                <div class="label"><?php echo T_("Api log"); ?></div>
            </div>
        </a>
    </div>

    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::this(); ?>/files'>
            <div class="statistic blue">
                <div class="value"><i class="text-3xl sf-file"></i></div>
                <div class="label"><?php echo T_("File"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::here(); ?>/application'>
            <div class="statistic green">
                <div class="value"><i class="text-3xl sf-android"></i></div>
                <div class="label"><?php echo T_("Android application queue"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::here(); ?>/gift'>
            <div class="statistic red">
                <div class="value"><i class="text-3xl sf-gift"></i></div>
                <div class="label"><?php echo T_("Gift card"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::kingdom(); ?>/crm'>
            <div class="statistic blue">
                <div class="value"><i class="text-3xl sf-users"></i></div>
                <div class="label"><?php echo T_("CRM"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::this(); ?>/ip'>
            <div class="statistic red">
                <div class="value"><i class="text-3xl sf-internet"></i></div>
                <div class="label"><?php echo T_("IP"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::this(); ?>/changelog'>
            <div class="statistic green">
                <div class="value"><i class="text-3xl sf-tree"></i></div>
                <div class="label"><?php echo T_("Changelog"); ?></div>
            </div>
        </a>
    </div>


    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::this(); ?>/plugin'>
            <div class="statistic green">
                <div class="value"><i class="text-3xl sf-money-banknote"></i></div>
                <div class="label"><?php echo T_("Plugin"); ?></div>
            </div>
        </a>
    </div>

    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::this(); ?>/portfolio'>
            <div class="statistic red">
                <div class="value"><i class="text-3xl sf-bell"></i></div>
                <div class="label"><?php echo T_("Portfolio"); ?></div>
            </div>
        </a>
    </div>

    <div class="c2 s6">
        <a class="bg-white block m-2 text-2xl" href='<?php echo \dash\url::this(); ?>/plan'>
            <div class="statistic green">
                <div class="value flex p-1">
                    <img class="mx-auto" src="<?php echo \dash\utility\icon::url('Capital', 'major', null, 'w-4') ?>" alt="">
                </div>
                <div class="label"><?php echo T_("Plans"); ?></div>
            </div>
        </a>
    </div>


</div>

