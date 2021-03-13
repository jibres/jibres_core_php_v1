<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>
<div class="avand-md">
  <?php if(\dash\data::domainConnected()) {?>
    <?php if(\dash\data::domainConnectedToMyBusiness()) {?>
      <div class="dcard grShadow grGreen2 grBlue2 x2 op100">
        <div><?php echo T_("Your domain was conncted to") ?></div>
        <a class="mB25 fcWhite900 fs20"><?php echo a(\dash\data::domainConnectedToMyBusiness(), 'detail', 'title') ?></a>
        <div class="f">
          <div class="pA5"><a href="<?php echo a(\dash\data::domainConnectedToMyBusiness(), 'detail', 'url'). '/a/setting/domain/manage?domain='. \dash\data::domainDetail_name() ?>" class="link"><div class="grShadow pA10 txtC"><?php echo T_("Manage Domain") ?></div></a></div>
        </div>
      </div>
    <?php }else{ ?>
      <div class="font-16">
        <div class="msg warn2">
          <?php echo T_("Your domain was connected to a business but we can not find this business in you business list!") ?>
          <p>
            <?php echo T_("If you need to know what happened") ?> <a href="<?php echo \dash\url::support(). '/ticket/add?title=domainConnectedToAnotherBusiness' ?>" class="link"><?php echo T_("Contact with us") ?></a>
          </p>
        </div>
      </div>
    <?php } //endif ?>
  <?php }else{ ?>
    <?php if(\dash\data::myBusinessList()) {?>
      <h5 class="txtB mT20"><?php echo T_("To create your website You can add domain to your business or create new business"); ?></h5>
      <nav class="items">
        <ul>
          <?php foreach (\dash\data::myBusinessList() as $key => $value) {?>
            <li>
              <a class="f" href="<?php echo a($value, 'url'). '/a/setting/domain/existdomain?domain='. \dash\data::domainDetail_name(); ?>">
                <img src="<?php echo a($value, 'logo'); ?>" alt="<?php echo a($value, 'title'); ?>">
                <div class="key"><?php echo a($value, 'title'); ?></div>
                <div class="value"><?php echo a($value, 'subdomain'); ?></div>
                <div class="go next"></div>
              </a>
            </li>
          <?php } //endif ?>
        </ul>
      </nav>

      <nav class="items">
        <ul>
          <li>
            <a class="f" href="<?php echo \dash\url::here(). '/business/start?domain='. \dash\data::domainDetail_name(); ?>">
              <div class="go plus ok"></div>
              <div class="key"><?php echo T_("Add New Business");?></div>
            </a>
          </li>
        </ul>
      </nav>

    <?php }else{ ?>
      <div class="welcome">
        <p><?php echo T_("Create your business now to connect your domain to your business"); ?></p>
        <h2><?php echo T_("Make your website and online business quickly!"); ?></h2>

        <div class="buildBtn">
          <a class="btn xl master" href="<?php echo \dash\url::here(). '/business/start?domain='. \dash\request::get('domain'); ?>" ><?php echo T_("Buil it now"); ?></a>
        </div>
      </div>
    <?php } // endif ?>
  <?php } //endif ?>
</div>