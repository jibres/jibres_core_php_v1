<div class="avand-sm zero">
    <div class="box">
      <div class='font-16'>
        <select class="select22" data-model='html' data-ajax--url="<?php echo \dash\url::this() ?>/search" data-shortkey-search data-placeholder="<?php echo T_("Find a setting") ?>"></select>
      </div>
    </div>
</div>

<div class="box" data-settings>
    <div class="body">
        <div class="row">
            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/general">
                    <div class="c-auto"><i class="sf-cog"></i></div>
                    <div class="c">
                        <h2><?php echo T_("General"); ?></h2>
                        <p><?php echo T_("View and update your business details"); ?></p>
                    </div>
                </a>
            </div>
            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/product">
                    <div class="c-auto"><i class="sf-package"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Products"); ?></h2>
                        <p><?php echo T_("Manage how your business products organized"); ?></p>
                    </div>
                </a>
            </div>


            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/factor">
                    <div class="c-auto"><i class="sf-receipt-shopping-streamline"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Factors"); ?></h2>
                        <p><?php echo T_("Manage how your business factors setting"); ?></p>
                    </div>
                </a>
            </div>


            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/shipping">
                    <div class="c-auto"><i class="sf-plane-airport"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Shipping"); ?></h2>
                        <p><?php echo T_("Manage how you ship orders to customers"); ?></p>
                    </div>
                </a>
            </div>

            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/company">
                    <div class="c-auto"><i class="sf-file"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Legal"); ?></h2>
                        <p><?php echo T_("Manage your business legal pages"); ?></p>
                    </div>
                </a>
            </div>

            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/cart">
                    <div class="c-auto"><i class="sf-shopping-cart"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Cart"); ?></h2>
                        <p><?php echo T_("Cart setting"); ?></p>
                    </div>
                </a>
            </div>

            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/order">
                    <div class="c-auto"><i class="sf-receipt-shopping-streamline"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Orders"); ?></h2>
                        <p><?php echo T_("Order setting"); ?></p>
                    </div>
                </a>
            </div>


            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/domain">
                    <div class="c-auto"><i class="sf-globe"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Domains"); ?></h2>
                        <p><?php echo T_("Connect business to your domain"); ?></p>
                    </div>
                </a>
            </div>

            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/thirdparty">
                    <div class="c-auto"><i class="sf-lamp"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Third Party Services"); ?></h2>
                        <p><?php echo T_("Connect to other services like google analytics, live chat"); ?></p>
                    </div>
                </a>
            </div>

            <?php if(\dash\url::isLocal() && false) {?>
             <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/branding">
                    <div class="c-auto"><i class="sf-check-circle fc-green"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Branding"); ?></h2>
                        <p><?php echo T_("Remove jibres branding"); ?></p>
                    </div>
                </a>
            </div>
        <?php } //endif ?>

        </div>
    </div>
</div>

<div class="box" data-settings>
    <div class="body">
        <div class="row">
            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::here(); ?>/accounting">
                    <div class="c-auto"><i class="sf-book"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Accounting"); ?></h2>
                        <p><?php echo T_("Manage your business accounting"); ?></p>
                    </div>
                </a>
            </div>
            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::here(); ?>/setting/menu">
                    <div class="c-auto"><i class="sf-bars"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Menu"); ?></h2>
                        <p><?php echo T_("Manage menu"); ?></p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>



<div class="box" data-settings>
    <div class="body">
        <div class="row">
            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::here(); ?>/pagebuilder">
                    <div class="c-auto"><i class="sf-monitor"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Online Store Website"); ?></h2>
                        <p><?php echo T_("Manage your business website settings"); ?></p>
                    </div>
                </a>
            </div>

            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::here(); ?>/android">
                    <div class="c-auto"><i class="sf-mobile"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Mobile Online Store"); ?></h2>
                        <p><?php echo T_("Manage your business app settings"); ?></p>
                    </div>
                </a>
            </div>

            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/pos">
                    <div class="c-auto"><i class="sf-cash-register"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Point of Sale Software"); ?></h2>
                        <p><?php echo T_("Manage your business pos configuration"); ?></p>
                    </div>
                </a>
            </div>

            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/social">
                    <div class="c-auto"><i class="sf-internet"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Social Marketing"); ?></h2>
                        <p><?php echo T_("Manage your business social marketing"); ?></p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>
