




<div class="f">
  <?php if(\dash\permission::check('cpPostsView')) {?>
  <div class="c s6">

    <a class="dcard" href="<?php echo \dash\url::here(); ?>/posts">
     <div class="statistic sm">
      <div class="label mB10"><i class="fs20 mRa5 sf-pinboard"></i> <?php echo T_("News"); ?> <span title='<?php echo T_("Item in all language"); ?>' class="badge"><?php echo \dash\fit::number(\dash\data::dashboardDetailNoLang_news()); ?></span></div>
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_news()); ?></div>
     </div>
    </a>

  </div>
  <?php }// endif ?>

  <?php if(\dash\permission::check('cpCategoryView')) {?>

    <div class="c s6">

      <a class="dcard" href="<?php echo \dash\url::here(); ?>/terms?type=cat">
       <div class="statistic sm">
        <div class="label mB10"><i class="fs20 mRa5 sf-grid"></i> <?php echo T_("Category"); ?> <span title='<?php echo T_("Item in all language"); ?>' class="badge"><?php \dash\fit::number(\dash\data::dashboardDetailNoLang_cats()); ?></span></div>
        <div class="value"><?php \dash\fit::number(\dash\data::dashboardDetail_cats()); ?></div>
       </div>
      </a>

    </div>
  <?php }// endif ?>
  <?php if(\dash\permission::check('cpTagView')) {?>
  <div class="c s6">
    <a class="dcard" href="<?php echo \dash\url::here(); ?>/terms?type=tag">
     <div class="statistic sm">
      <div class="label mB10"><i class="fs20 mRa5 sf-tags"></i> <?php echo T_("Tags"); ?> <span title='<?php echo T_("Item in all language"); ?>' class="badge"><?php echo \dash\fit::number(\dash\data::dashboardDetailNoLang_tags()); ?></span></div>
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_tags()); ?></div>
     </div>
    </a>
  </div>
  <?php }// endif ?>
  <?php if(\dash\permission::check('cpPageView')) {?>
  <div class="c s6">

    <a class="dcard" href="<?php echo \dash\url::here(); ?>/posts?type=page">
     <div class="statistic sm">
      <div class="label mB10"><i class="fs20 mRa5 sf-files-o"></i> <?php echo T_("Pages"); ?> <span title='<?php echo T_("Item in all language"); ?>' class="badge"><?php echo \dash\fit::number(\dash\data::dashboardDetailNoLang_pages()); ?></span></div>
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_pages()); ?></div>
     </div>
    </a>

  </div>
  <?php }// endif ?>
</div>



  <a class="cbox pA0">
 <div class="chart x4" id="postchart"></div>
</a>

	<div class="f">
  <?php if(\dash\permission::check('cpHelpCenterView')) {?>
  <div class="c s6">

    <a class="dcard" href="<?php echo \dash\url::here(); ?>/posts?type=help">
     <div class="statistic sm">
      <div class="label mB10"><i class="fs20 mRa5 sf-info-circle"></i> <?php echo T_("Help Center Article"); ?> <span title='<?php echo T_("Item in all language"); ?>' class="badge"><?php echo \dash\fit::number(\dash\data::dashboardDetailNoLang_helpcenter()); ?></span></div>
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_helpcenter()); ?></div>
     </div>
    </a>

  </div>
  <?php }// endif ?>
  <?php if(\dash\permission::check('cpTagHelpAdd')) {?>
  <div class="c s6">

    <a class="dcard" href="<?php echo \dash\url::here(); ?>/terms?type=help_tag">
     <div class="statistic sm">
      <div class="label mB10"><i class="fs20 mRa5 sf-clone"></i> <?php echo T_("Help tags"); ?> <span title='<?php echo T_("Item in all language"); ?>' class="badge"><?php echo \dash\fit::number(\dash\data::dashboardDetailNoLang_helpcentertags()); ?></span></div>
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_helpcentertags()); ?></div>
     </div>
    </a>
  </div>
  <?php }// endif ?>
  <?php if(\dash\permission::check('cpTagSupportAdd')) {?>
    <div class="c s6">
        <a class="dcard" href="<?php echo \dash\url::here(); ?>/terms?type=support_tag">
     <div class="statistic sm">
      <div class="label mB10"><i class="fs20 mRa5 sf-bug"></i> <?php echo T_("Support tags"); ?> <span title='<?php echo T_("Item in all language"); ?>' class="badge"><?php echo \dash\fit::number(\dash\data::dashboardDetailNoLang_supporttags()); ?></span></div>
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_supporttags()); ?></div>
     </div>
    </a>
  </div>
  <?php }// endif ?>
  <?php if(\dash\permission::check('supportTicketManage')) {?>

  <div class="c s6">
      <a class="dcard" href="<?php echo \dash\url::kingdom(); ?>/support/ticket">
     <div class="statistic sm">
      <div class="label mB10"><i class="fs20 mRa5 sf-life-ring"></i> <?php echo T_("Tickets"); ?> <span title='<?php echo T_("Item in all language"); ?>' class="badge"><?php echo \dash\fit::number(\dash\data::dashboardDetailNoLang_tickets()); ?></span></div>
      <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_tickets()); ?></div>
     </div>
    </a>
  </div>
  <?php }// endif ?>

</div>


  <a class="cbox pA0">
 <div class="chart x4" id="wordcloud"></div>
</a>


  <div class="f">
    <div class="c s12">
      <div class="pRa5">

        <div class="cbox fs11 mB10">
          <h2><?php echo T_("Latest News"); ?></h2>
          <?php if(is_array(\dash\data::dashboardDetail_latesPost())) {?>
            <?php foreach (\dash\data::dashboardDetail_latesPost() as $key => $value) {?>

            <a class="msg f" href="<?php echo \dash\url::kingdom(); ?>/<?php echo \dash\get::index($value, 'url'); ?>">
              <div><?php if(isset($value['title']) && $value['title']) { echo $value['title']; } else { echo T_("Without title");} ?></div>
              <div class="cauto"><?php echo \dash\fit::date_human(\dash\get::index($value, 'datecreated')); ?></div>
            </a>

        <?php }//endfor ?>

        <?php }//endif ?>
        </div>


      </div>
    </div>

    <div class="c s12">
      <div class="pRa5">

        <div class="cbox fs11 mB10">
          <h2><?php echo T_("Latest Help center"); ?></h2>
          <?php if(is_array(\dash\data::dashboardDetail_latesHelp())) {?>
            <?php foreach (\dash\data::dashboardDetail_latesHelp() as $key => $value) {?>

            <a class="msg f" href="<?php echo \dash\url::kingdom(); ?>/support/<?php echo \dash\get::index($value, 'url'); ?>">

              <div><?php if(isset($value['title']) && $value['title']) { echo $value['title']; } else { echo T_("Without title");} ?></div>
              <div class="cauto"><?php echo \dash\fit::date_human(\dash\get::index($value, 'datecreated')); ?></div>
            </a>
          <?php }//endfor ?>

        <?php }//endif ?>
        </div>


      </div>
    </div>

    <div class="c s12">
      <div class="pRa5">

        <div class="cbox fs11 mB10">
          <h2><?php echo T_("Latest tag"); ?></h2>
          <?php if(is_array(\dash\data::dashboardDetail_latesTag())) {?>
            <?php foreach (\dash\data::dashboardDetail_latesTag() as $key => $value) {?>

             <a class="msg f">
              <div><?php if(isset($value['title']) && $value['title']) { echo $value['title']; } else { echo T_("Without title");} ?></div>
              <div class="cauto"><?php echo \dash\fit::date_human(\dash\get::index($value, 'datecreated')); ?></div>
            </a>
          <?php }//endfor ?>

        <?php }//endif ?>
        </div>


      </div>
    </div>

  </div>

