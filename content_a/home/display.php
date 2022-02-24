
<?php $dashboardData = \dash\data::dashboardData(); ?>
  <?php if(\dash\data::businessCheckLisst_visible()) {?>
<div class="row">
    <div class="c-xs-12 c-sm-12 c-md-9">
    <?php } //endif ?>

    <?php if(!\lib\app\plugin\business::is_activated('sms_pack') && \dash\url::isLocal()) { ?>
        <a href="<?php echo \dash\url::here(). '/plugin/view/sms_pack' ?>">
          <div class="alert-danger mb-3 font-bold">
            <?php echo T_("Your SMS package is over. To send your SMS, please purchase the SMS package") ?>
          </div>
        </a>
    <?php } //endif ?>
    <div class="text-sm">
      <?php if(a($dashboardData, 'new_order')) {?>
        <a href="<?php echo \dash\url::here(). '/order/unprocessed' ?>">
          <div class="alert-success mb-3 font-bold">
            <?php echo T_("You have :val Unprocessed order", ['val' => \dash\fit::number(a($dashboardData, 'new_order'))]) ?>
          </div>
        </a>
      <?php } //endif ?>
      <?php if(a($dashboardData, 'new_ticket')) {?>
        <a href="<?php echo \dash\url::kingdom(). '/crm/ticket/datalist?status=awaiting' ?>">
          <div class="alert-success mb-3 font-bold">
            <?php echo T_("You have :val Unanswered ticket", ['val' => \dash\fit::number(a($dashboardData, 'new_ticket'))]) ?>
          </div>
        </a>
      <?php } //endif ?>
      <?php if(a($dashboardData, 'new_comment')) {?>
        <a href="<?php echo \dash\url::kingdom(). '/cms/comments?status=awaiting' ?>">
          <div class="alert-success mb-3 font-bold">
            <?php echo T_("You have :val awaiting comment", ['val' => \dash\fit::number(a($dashboardData, 'new_comment'))]) ?>
          </div>
        </a>
      <?php } //endif ?>
      <?php if(a($dashboardData, 'notif_count')) {?>
        <a href="<?php echo \dash\url::kingdom(). '/crm/notification/me' ?>">
          <div class="alert-success mb-3 font-bold">
            <?php echo T_("You have :val new message!", ['val' => \dash\fit::number(a($dashboardData, 'notif_count'))]) ?>
          </div>
        </a>
      <?php } //endif ?>
      <?php if(a($dashboardData, 'new_form_answer')) {?>
        <?php foreach(a($dashboardData, 'new_form_answer') as $key => $value) {?>
          <a href="<?php echo \dash\url::kingdom(). '/a/form/answer?id='. a($value, 'id') ?>">
            <div class="alert-success mb-3 font-bold">
              <?php echo T_("You have :val not reviewed answer in :form", ['val' => \dash\fit::number(a($value, 'count_need_review')), 'form' => a($value, 'title')]) ?>
            </div>
          </a>
        <?php } //endif ?>
      <?php } //endif ?>
    </div>
    <?php if(\dash\permission::check('_group_products')) {?>
      <div id="chartdiv" class="box chart x400" data-abc='a/homepage'></div>
    <?php } //endif ?>
    <div class="hide">
      <div id="chartcategory"><?php echo a(\dash\data::dashboardData(), 'chart', 'categories'); ?></div>
      <div id="chartsum"><?php echo a(\dash\data::dashboardData(), 'chart', 'sum'); ?></div>
      <div id="chartcount"><?php echo a(\dash\data::dashboardData(), 'chart', 'count'); ?></div>
      <div id="charttitle"><?php echo T_("Sum factor price and count of it group by hours"); ?></div>
      <div id="charttitlesum"><?php echo T_("Sum price"); ?></div>
      <div id="charttitlecount"><?php echo T_("Count"); ?></div>
      <div id="charttitleunit"><?php echo \lib\currency::unit(); ?></div>
    </div>
  </div>

  <?php if(\dash\data::businessCheckLisst_visible()) {?>
  <div class="c-xs-12 c-sm-12 c-md-3">
    <section class="circularChartBox">
      <?php $myPercent=intval(\dash\data::businessCheckLisst_percent()) ; include core.'/layout/elements/circularChart.php';?>
      <h3><?php echo T_("Business setup");?></h3>

    </section>

    <nav class="items long">
      <ul>
        <?php foreach (\dash\data::businessCheckLisst_list() as $key => $value) {?>
          <li>
            <a class="f" href="<?php echo a($value, 'link') ?>">
              <div class="key"><?php echo a($value, 'title');?></div>
              <div class="go <?php if(a($value, 'ok')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
            </a>
          </li>
        <?php } //endfor ?>
      </ul>
    </nav>
  </div>
</div>
<?php } //endif ?>
