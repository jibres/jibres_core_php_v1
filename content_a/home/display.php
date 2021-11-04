<?php $dashboardData = \dash\data::dashboardData(); ?>


    <div class="font-12">
      <?php if(a($dashboardData, 'new_order')) {?>
        <a href="<?php echo \dash\url::here(). '/order/unprocessed' ?>">
          <div class="jalert-success mb-3 txtB">
            <?php echo T_("You have :val Unprocessed order", ['val' => \dash\fit::number(a($dashboardData, 'new_order'))]) ?>
          </div>
        </a>
      <?php } //endif ?>
      <?php if(a($dashboardData, 'new_ticket')) {?>
        <a href="<?php echo \dash\url::kingdom(). '/crm/ticket/datalist?status=awaiting' ?>">
          <div class="jalert-success mb-3 txtB">
            <?php echo T_("You have :val Unanswered ticket", ['val' => \dash\fit::number(a($dashboardData, 'new_ticket'))]) ?>
          </div>
        </a>
      <?php } //endif ?>
       <?php if(a($dashboardData, 'new_comment')) {?>
        <a href="<?php echo \dash\url::kingdom(). '/cms/comments?status=awaiting' ?>">
          <div class="jalert-success mb-3 txtB">
            <?php echo T_("You have :val awaiting comment", ['val' => \dash\fit::number(a($dashboardData, 'new_comment'))]) ?>
          </div>
        </a>
      <?php } //endif ?>
      <?php if(a($dashboardData, 'notif_count')) {?>
        <a href="<?php echo \dash\url::kingdom(). '/crm/notification/me' ?>">
          <div class="jalert-success mb-3 txtB">
            <?php echo T_("You have :val new message!", ['val' => \dash\fit::number(a($dashboardData, 'notif_count'))]) ?>
          </div>
        </a>
      <?php } //endif ?>
      <?php if(a($dashboardData, 'new_form_answer')) {?>
        <?php foreach(a($dashboardData, 'new_form_answer') as $key => $value) {?>
          <a href="<?php echo \dash\url::kingdom(). '/a/form/answer?id='. a($value, 'id') ?>">
            <div class="jalert-success mb-3 txtB">
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