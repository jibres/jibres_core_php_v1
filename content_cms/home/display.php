<?php $dashboardDetail = \dash\data::dashboardDetail(); ?>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
        <div id="chartdivcrmhome" class="box chart x260 s0" data-abc='crm/homepage'>
      <div class="hide">
        <div id="charttitleunit"><?php echo T_("Count") ?></div>
        <div id="chartverifytitle"><?php echo T_("Success transactions") ?></div>
        <div id="chartunverifytitle"><?php echo T_("Unsuccess transactions") ?></div>

        <div id="charttitle"><?php echo T_("Chart transactions per day in last 3 month") ?></div>
        <div id="chartcategory"><?php echo a($dashboardDetail, 'chart', 'category') ?></div>
        <div id="chartverify"><?php echo a($dashboardDetail, 'chart', 'verify') ?></div>
        <div id="chartunverify"><?php echo a($dashboardDetail, 'chart', 'unverify') ?></div>
      </div>
    </div>

    <section class="row">
     <div class="c-xs-0 c-sm-4 c-md-4">
      <a href="<?php echo \dash\url::this() ?>/posts?specialaddress=customized" class="circularChartBox">
       <?php $myPercent= a($dashboardDetail, 'specialaddress_percent');$myColor='auto';include core.'layout/elements/circularChart.php';?>
       <h3><?php echo T_("Special Address");?></h3>
      </a>
     </div>
     <div class="c-xs-6 c-sm-4 c-md-4">
      <a href="<?php echo \dash\url::this() ?>/posts?havecover=y" class="circularChartBox">
       <?php $myPercent= a($dashboardDetail, 'havecover_percent');$myColor='auto';include core.'layout/elements/circularChart.php';?>
       <h3><?php echo T_("Cover was set");?></h3>
      </a>
     </div>

     <div class="c-xs-6 c-sm-4 c-md-4">
      <a href="<?php echo \dash\url::this() ?>/posts" class="circularChartBox">
       <?php $myPercent= a($dashboardDetail, 'publish_percent');$myColor='auto';include core.'layout/elements/circularChart.php';?>
       <h3><?php echo T_("Publish percent");?></h3>
      </a>
     </div>
    </section>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">
    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts">
            <div class="key"><?php echo T_('All Posts');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_post()); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts?subtype=standard">
            <div class="key"><?php echo T_('Standard post');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_standard()); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts?subtype=video">
            <div class="key"><?php echo T_('Video');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_video()); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts?subtype=gallery">
            <div class="key"><?php echo T_('Gallery');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_gallery()); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts?subtype=audio">
            <div class="key"><?php echo T_('Podcast');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_audio()); ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>
    <?php if(\dash\permission::check('cmsCommentView')) {?>
      <nav class="items long">
        <ul>
          <li>
            <a class="item f" href="<?php echo \dash\url::here();?>/comments">
              <div class="key"><?php echo T_('All Comments');?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_comments()); ?></div>
              <div class="go"></div>
            </a>
          </li>
          <li>
            <a class="item f" href="<?php echo \dash\url::here();?>/comments?status=awaiting">
              <div class="key"><?php echo T_('Awaiting comments');?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_comments_awaiting()); ?></div>
              <div class="go"></div>
            </a>
          </li>
          <li>
            <a class="item f" href="<?php echo \dash\url::here();?>/comments?status=approved">
              <div class="key"><?php echo T_('Approved comments');?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_comments_approved()); ?></div>
              <div class="go"></div>
            </a>
          </li>
        </ul>
      </nav>
    <?php }// endif ?>
    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/tag">
            <div class="key"><?php echo T_('Tags');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_tags()); ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>
    <?php if(\dash\permission::check('cmsAttachmentView')) {?>
      <nav class="items long">
        <ul>
          <li class="">
            <a class="item f" href="<?php echo \dash\url::here();?>/files">
              <div class="key"><?php echo T_('Files');?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_comments()); ?></div>
              <div class="go"></div>
            </a>
          </li>
        </ul>
      </nav>
    <?php }// endif ?>
  </div>
</div>


<div class="row font-14 mT5">
  <div class="c-xs-12 c-sm-12 c-md-6">
    <p class="mB5-f font-14"><?php echo T_("Latest posts") ?></p>
    <?php if(\dash\data::dashboardDetail_latesPost()) {?>
      <nav class="items long">
        <ul>
          <?php foreach (\dash\data::dashboardDetail_latesPost() as $key => $value) {?>
            <li>
              <a class="item f" href="<?php echo \dash\url::here(); ?>/posts/edit?id=<?php echo $value['id']; ?>">
                <img src="<?php echo a($value, 'thumb'); ?>" alt="Thumb image - <?php echo a($value, 'title'); ?>">
                <div class="key"><?php  echo $value['title'];  ?></div>
                <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
              </a>
            </li>
          <?php } //endfor ?>
        </ul>
      </nav>
    <?php } else { ?>
      <p class="msg"><?php echo T_("No post have been registered yet"); ?></p>
    <?php } //endif ?>
  </div>

  <div class="c-xs-12 c-sm-12 c-md-6">
    <p class="mB5-f font-14"><?php echo T_("Latest comment") ?></p>
    <?php if(\dash\data::dashboardDetail_latesComment()) {?>
      <nav class="items long">
        <ul>
          <?php foreach (\dash\data::dashboardDetail_latesComment() as $key => $value) { ?>
            <li>
              <a class="item f" href="<?php echo \dash\url::here(); ?>/comments/view?cid=<?php echo $value['id']; ?>">
                <img src="<?php echo a($value, 'avatar'); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
                <div class="key"><?php if(isset($value['title']) && $value['title']) { echo $value['title']; }else{ echo mb_substr($value['content'], 0, 20); } ?></div>
                <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
              </a>
            </li>
          <?php } //endfor ?>
        </ul>
      </nav>
    <?php } else { ?>
      <p class="msg"><?php echo T_("No comment have been registered yet"); ?></p>
    <?php } //endif ?>
  </div>

</div>
