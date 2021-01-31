
<?php $myHide = \dash\url::isLocal() ? null : 'hide'; $myHide = 'hide';?>
<div class="box" data-settings>
    <?php if(false) {?>
    <div class="pad">
        <div>

         <select class="select22" data-link data-placeholder="<?php echo T_("Search") ?>">
                <option readonly value=""><span><?php echo T_("Search"); ?></span></option>
                <?php foreach (\dash\data::settingSearch() as $key => $value) {?>
                    <option value="<?php echo $value['link']; ?>"><?php echo $value['title']; ?></option>
                <?php } //endif ?>
                </select>
        </div>
    </div>
<?php } //endif ?>

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
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/place">
                    <div class="c-auto"><i class="sf-map-marker"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Locations"); ?></h2>
                        <p><?php echo T_("Manage the place you stock inventory and sell products"); ?></p>
                    </div>
                </a>
            </div>

            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/vat">
                    <div class="c-auto"><i class="sf-receipt-shopping-streamline"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Taxes"); ?></h2>
                        <p><?php echo T_("Manage how your business charges taxes"); ?></p>
                    </div>
                </a>
            </div>

            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/payment">
                    <div class="c-auto"><i class="sf-credit-card"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Payment Providers"); ?></h2>
                        <p><?php echo T_("Enable and manage your business payment providers"); ?></p>
                    </div>
                </a>
            </div>

            <div class="<?php echo $myHide; ?> c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/account">
                    <div class="c-auto"><i class="sf-user-close-security"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Account"); ?></h2>
                        <p><?php echo T_("Manage your accounts and permissions"); ?></p>
                    </div>
                </a>
            </div>

            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/shipping">
                    <div class="c-auto"><i class="sf-flight"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Shipping"); ?></h2>
                        <p><?php echo T_("Manage how you ship orders to customers"); ?></p>
                    </div>
                </a>
            </div>

            <div class="<?php echo $myHide; ?> c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/checkout">
                    <div class="c-auto"><i class="sf-shopping-cart"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Checkout"); ?></h2>
                        <p><?php echo T_("Customize your online checkout process"); ?></p>
                    </div>
                </a>
            </div>

            <div class="<?php echo $myHide; ?> c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/notifications">
                    <div class="c-auto"><i class="sf-bell"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Notifications"); ?></h2>
                        <p><?php echo T_("Manage notification send to you and your cusotmers"); ?></p>
                    </div>
                </a>
            </div>

            <div class="<?php echo $myHide; ?> c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/billing">
                    <div class="c-auto"><i class="sf-wallet-money"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Billing"); ?></h2>
                        <p><?php echo T_("Your billing information and view your invoices"); ?></p>
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
                <a class="row" data-item href="<?php echo \dash\url::here(); ?>/form">
                    <div class="c-auto"><i class="sf-edit"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Form Builder"); ?></h2>
                        <p><?php echo T_("Create online forms and publish them."); ?> <?php echo T_("Collect data."); ?></p>
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
                <a class="row" data-item href="<?php echo \dash\url::kingdom(); ?>/cms">
                    <div class="c-auto"><i class="sf-file-text"></i></div>
                    <div class="c">
                        <h2><?php echo T_("CMS"); ?></h2>
                        <p><?php echo T_("Manage your business news and contents"); ?></p>
                    </div>
                </a>
            </div>

            <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::kingdom(); ?>/crm">
                    <div class="c-auto"><i class="sf-atom"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Customers - CRM"); ?></h2>
                        <p><?php echo T_("Manage business customers"); ?></p>
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
                <a class="row" data-item href="<?php echo \dash\url::here(); ?>/website">
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
                    <div class="c-auto"><i class="sf-tools"></i></div>
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

             <div class="c-xs-12 c-md-6 c-lg-4 c-xxl-3">
                <a class="row" data-item href="<?php echo \dash\url::this(); ?>/telegram">
                    <div class="c-auto"><i class="sf-paper-plane"></i></div>
                    <div class="c">
                        <h2><?php echo T_("Telegram settings"); ?></h2>
                        <p><?php echo T_("Manage your telegram marketing"); ?></p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>
