
<div class="box" data-settings>
    <div class="body">
        <div class="row">
            <div class="mt-5 c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/general">
                    <div class="c-auto"><div class=" w-20 p-5 pt-1"><?php echo \dash\utility\icon::svg('Settings') ?></div></div>
                    <div class="c">
                        <h2><?php echo T_("General"); ?></h2>
                        <p class="text-gray-500"><?php echo T_("View and update your business details"); ?></p>
                    </div>
                </a>
            </div>
            <div class="mt-5 c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/product">
                    <div class="c-auto"><div class=" w-20 p-5 pt-1"><?php echo \dash\utility\icon::svg('Products') ?></div></div>
                    <div class="c">
                        <h2><?php echo T_("Products"); ?></h2>
                        <p class="text-gray-500"><?php echo T_("Manage how your business products organized"); ?></p>
                    </div>
                </a>
            </div>


            <div class="mt-5 c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/factor">
                    <div class="c-auto"><div class=" w-20 p-5 pt-1"><?php echo \dash\utility\icon::svg('Orders') ?></div></div>
                    <div class="c">
                        <h2><?php echo T_("Factors"); ?></h2>
                        <p class="text-gray-500"><?php echo T_("Manage how your business factors setting"); ?></p>
                    </div>
                </a>
            </div>


            <div class="mt-5 c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/shipping">
                    <div class="c-auto"><div class=" w-20 p-5 pt-1"><?php echo \dash\utility\icon::svg('Shipment') ?></div></div>
                    <div class="c">
                        <h2><?php echo T_("Shipping"); ?></h2>
                        <p class="text-gray-500"><?php echo T_("Manage how you ship orders to customers"); ?></p>
                    </div>
                </a>
            </div>


            <div class="mt-5 c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/order">
                    <div class="c-auto"><div class=" w-20 p-5 pt-1"><?php echo \dash\utility\icon::svg('Orders') ?></div></div>
                    <div class="c">
                        <h2><?php echo T_("Orders"); ?></h2>
                        <p class="text-gray-500"><?php echo T_("Order setting"); ?></p>
                    </div>
                </a>
            </div>



            <div class="mt-5 c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/thirdparty">
                    <div class="c-auto"><div class=" w-20 p-5 pt-1"><?php echo \dash\utility\icon::svg('Hint') ?></div></div>
                    <div class="c">
                        <h2><?php echo T_("Third Party Services"); ?></h2>
                        <p class="text-gray-500"><?php echo T_("Connect to other services like google analytics, live chat"); ?></p>
                    </div>
                </a>
            </div>

             <div class="mt-5 c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/notification">
                    <div class="c-auto"><div class=" w-20 p-5 pt-1"><?php echo \dash\utility\icon::svg('Notification', 'major') ?></div></div>
                    <div class="c">
                        <h2><?php echo T_("Notification"); ?></h2>
                        <p class="text-gray-500"><?php echo T_("Notification settings and changing the message format"); ?></p>
                    </div>
                </a>
            </div>


        </div>
    </div>
</div>





<div class="box" data-settings>
    <div class="body">
        <div class="row">
        <?php if(\dash\permission::check('_group_setting')) {?>
            <div class="mt-5 c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-direct data-item href="<?php echo \dash\url::kingdom(). '/site'; ?>">
                    <div class="c-auto"><div class=" w-20 p-5 pt-1"><?php echo \dash\utility\icon::svg('Store') ?></div></div>
                    <div class="c">
                        <h2><?php echo T_("Website Builder"); ?></h2>
                        <p class="text-gray-500"><?php echo T_("Manage your business website settings"); ?></p>
                    </div>
                </a>
            </div>
        <?php } // endif ?>

            <div class="mt-5 c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::here(); ?>/android">
                    <div class="c-auto"><div class=" w-20 p-5 pt-1"><?php echo \dash\utility\icon::svg('Mobile') ?></div></div>
                    <div class="c">
                        <h2><?php echo T_("Mobile Online Store"); ?></h2>
                        <p class="text-gray-500"><?php echo T_("Manage your business app settings"); ?></p>
                    </div>
                </a>
            </div>

            <div class="mt-5 c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/pos">
                    <div class="c-auto"><div class=" w-20 p-5 pt-1"><?php echo \dash\utility\icon::svg('PointOfSale') ?></div></div>
                    <div class="c">
                        <h2><?php echo T_("Point of Sale Software"); ?></h2>
                        <p class="text-gray-500"><?php echo T_("Manage your business pos configuration"); ?></p>
                    </div>
                </a>
            </div>

            <div class="mt-5 c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/social">
                    <div class="c-auto"><div class=" w-20 p-5 pt-1"><?php echo \dash\utility\icon::svg('SocialAd') ?></div></div>
                    <div class="c">
                        <h2><?php echo T_("Social Marketing"); ?></h2>
                        <p class="text-gray-500"><?php echo T_("Manage your business social marketing"); ?></p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>
