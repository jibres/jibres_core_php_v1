<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>
<div class="avand-md">
  <div class="box">
    <div class="body">

        <?php if(\dash\data::domainConnected()) {?>

          <?php if(\dash\data::domainConnectedToMyBusiness()) {?>

            <div class="c-xs-12 c-sm-6">
              <div class="dcard grShadow grGreen2 grBlue2 x3 op100">
                <a class="mB25 fcWhite900 fs20"><?php echo \dash\get::index(\dash\data::domainConnectedToMyBusiness(), 'detail', 'title') ?></a>
                <div class="f">
                  <div class="c6 pA5"><a href="<?php echo \dash\url::current(). '?type=edit&id='. $value['id']; ?>" class="link"><div class="grShadow pA10 txtC"><?php echo T_("Edit") ?></div></a></div>
                </div>
              </div>
            </div>

          <?php }else{ ?>
            <div class="msg warn2">
              <?php echo T_("Your domain was connected to a business but we can not find this business in you business list!") ?>
              <p>
                <?php echo T_("If you need to know wath happend") ?> <a href="<?php echo \dash\url::support(). '/ticket/add?title=domainConnectedToAnotherBusiness' ?>" class="link"><?php echo T_("Contact with us") ?></a>
              </p>
            </div>

          <?php } //endif ?>

        <?php }else{ ?>

          <?php if(\dash\data::myBusinessList()) {?>
                 <h5 class="txtB mT20"><?php echo T_("Business that you are owner"); ?></h5>
     <nav class="items">
      <ul>
      <?php foreach (\dash\data::myBusinessList() as $key => $value) {?>
         <li>
          <a class="f" href="<?php echo \dash\get::index($value, 'url'); ?>/a">
           <img src="<?php echo \dash\get::index($value, 'logo'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
           <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
           <div class="value"><?php echo \dash\get::index($value, 'subdomain'); ?></div>
           <div class="go next"></div>
          </a>
         </li>
      <?php } //endif ?>
      </ul>
     </nav>

     <nav class="items">
      <ul>
       <li>
        <a class="f" href="<?php echo \dash\url::here(); ?>/business/start">
         <div class="go plus ok"></div>
         <div class="key"><?php echo T_("Add New Business");?></div>
        </a>
       </li>
      </ul>
     </nav>

          <?php }else{ ?>

          <?php } // endif ?>

        <?php } //endif ?>
    </div>
  </div>
</div>

