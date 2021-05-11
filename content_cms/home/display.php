<?php $dashboardDetail = \dash\data::dashboardDetail(); ?>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">

      <div class='mB10 font-14'>
        <select class="select22" data-model='html'  data-ajax--url="<?php echo \dash\url::here() ?>?json=true" data-shortkey-search data-placeholder="<?php echo T_("Search in posts and tags") ?>"></select>
      </div>
        <div id="chartdivcmshome" class="box chart x285 s0" data-abc='cms/homepage' data-abc-v='4'>
      <div class="hide">
        <div id="chardatatitle"><?php echo T_("Draft") ?></div>
        <div id="chardatatitlepublish"><?php echo T_("Publish") ?></div>
        <div id="charttitle"><?php echo T_("Posts per month in last year") ?></div>
        <div id="chartcategory"><?php echo a($dashboardDetail, 'chart', 'category') ?></div>
        <div id="chartdatapublish"><?php echo a($dashboardDetail, 'chart', 'datapublish') ?></div>
        <div id="chartdatadraft"><?php echo a($dashboardDetail, 'chart', 'datadraft') ?></div>
      </div>
    </div>

    <section class="row">
     <div class="c-xs-6 c-sm-4 c-md-4">
      <a href="<?php echo \dash\url::this() ?>/posts?specialaddress=customized" class="circularChartBox">
       <?php $myPercent= a($dashboardDetail, 'specialaddress_percent');$myColor='auto';include core.'layout/elements/circularChart.php';?>
       <h3><?php echo T_("SEO Friendly URL");?></h3>
      </a>
     </div>
     <div class="c-xs-6 c-sm-4 c-md-4">
      <a href="<?php echo \dash\url::this() ?>/posts?havecover=y" class="circularChartBox">
       <?php $myPercent= a($dashboardDetail, 'havecover_percent');$myColor='auto';include core.'layout/elements/circularChart.php';?>
       <h3><?php echo T_("Social Media Cover");?></h3>
      </a>
     </div>

     <div class="c-xs-0 c-sm-4 c-md-4">
      <a href="<?php echo \dash\url::this() ?>/posts" class="circularChartBox">
       <?php $myPercent= a($dashboardDetail, 'publish_percent');$myColor='auto';include core.'layout/elements/circularChart.php';?>
       <h3><?php echo T_("Publish vs Draft");?></h3>
      </a>
     </div>
    </section>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">
    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts">
            <i class="sf-archive"></i>

            <div class="key"><?php echo T_('All Posts');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_post()); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts?subtype=standard">
            <i class="sf-news"></i>
            <div class="key"><?php echo T_('Standard Posts');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_standard()); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts?subtype=gallery">
            <i class="sf-picture"></i>
            <div class="key"><?php echo T_('Gallery');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_gallery()); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts?subtype=video">
            <i class="sf-film"></i>
            <div class="key"><?php echo T_('Video');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_video()); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts?subtype=audio">
            <i class="sf-music"></i>
            <div class="key"><?php echo T_('Podcast');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_audio()); ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>
    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/hashtag">
            <i class="sf-pound"></i>
            <div class="key"><?php echo T_('Hashtag');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_tags()); ?></div>
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
              <i class="sf-comments"></i>
              <div class="key"><?php echo T_('All Comments');?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_comments()); ?></div>
              <div class="go"></div>
            </a>
          </li>
          <li>
            <a class="item f" href="<?php echo \dash\url::here();?>/comments?status=awaiting">
<?php
$awaitingColor = '';
if(\dash\data::dashboardDetail_comments_awaiting() > 0)
{
  $awaitingColor = " fc-red";
}
?>
              <i class="sf-commenting<?php echo $awaitingColor;?>"></i>
              <div class="key"><?php echo T_('Awaiting Moderation');?></div>
              <div class="value<?php echo $awaitingColor;?>"><?php echo \dash\fit::number(\dash\data::dashboardDetail_comments_awaiting()); ?></div>
              <div class="go<?php echo $awaitingColor;?>"></div>
            </a>
          </li>
        </ul>
      </nav>
    <?php }// endif ?>

<?php if(\dash\permission::check('cmsConfig')) {?>
      <nav class="items long">
        <ul>
          <li class="">
            <a class="item f" href="<?php echo \dash\url::here();?>/config">
              <i class="sf-settings"></i>
              <div class="key"><?php echo T_('Config');?></div>
              <div class="go"></div>
            </a>
          </li>
        </ul>
      </nav>
<?php }// endif ?>



<?php if(\dash\permission::check('cmsAttachmentView')) {?>
      <nav class="items long">
        <ul>
          <li class="">
            <a class="item f" href="<?php echo \dash\url::here();?>/files">
              <i class="sf-file"></i>
              <div class="key"><?php echo T_('Files');?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_files()); ?></div>
              <div class="go"></div>
            </a>
          </li>
        </ul>
      </nav>
<?php }// endif ?>

      <nav class="items long">
        <ul>
          <li class="">
            <a class="item f" href="<?php echo \dash\url::here();?>/seo">
              <div class="key"><?php echo T_('Smart SEO');?></div>
              <div class="value"><?php echo a(\dash\data::dashboardDetail(), 'seostar_html'); ?></div>
            </a>
          </li>
        </ul>
      </nav>

  </div>
</div>


<div class="row font-14 mT5">
  <div class="c-xs-12 c-sm-12 c-md-6">
    <p class="mB5-f font-14"><?php echo T_("Latest Posts") ?></p>
    <?php if(\dash\data::dashboardDetail_latesPost()) {?>
      <nav class="items long">
        <ul>
          <?php foreach (\dash\data::dashboardDetail_latesPost() as $key => $value) {?>
            <li>
              <a class="item f" href="<?php echo \dash\url::here(); ?>/posts/edit?id=<?php echo $value['id']; ?>">
<?php if(a($value, 'thumb')) {?>
                <img src="<?php echo \dash\fit::img(a($value, 'thumb')); ?>" alt="Thumb image - <?php echo a($value, 'title'); ?>">
<?php } else {
$type = 'news';
switch (a($value, 'subtype'))
{
  case 'standard':
    $type = 'news';
    break;

  case 'gallery':
    $type = 'picture';
    break;

  case 'video':
    $type = 'film';
    break;

  case 'audio':
    $type = 'music';
    break;

  default:
    break;
}
echo '<i class="sf-'. $type. '"></i>';
}?>
                <div class="key"><?php  echo $value['title'];  ?></div>
                <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
              </a>
            </li>
          <?php } //endfor ?>
        </ul>
      </nav>
    <?php } else { ?>
      <p class="msg"><?php echo T_("No post has registered yet!"); ?></p>
    <?php } //endif ?>
  </div>

  <div class="c-xs-12 c-sm-12 c-md-6">
    <p class="mB5-f font-14"><?php echo T_("Latest Comments") ?></p>
    <?php if(\dash\data::dashboardDetail_latesComment()) {?>
      <nav class="items long">
        <ul>
          <?php foreach (\dash\data::dashboardDetail_latesComment() as $key => $value) { ?>
            <li>
              <a class="item f" href="<?php echo \dash\url::here(); ?>/comments/view?cid=<?php echo $value['id']; ?>">
                <img src="<?php echo \dash\fit::img(a($value, 'avatar')); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
                <div class="key"><?php if(isset($value['title']) && $value['title']) { echo $value['title']; }else{ echo mb_substr($value['content'], 0, 20); } ?></div>
                <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
              </a>
            </li>
          <?php } //endfor ?>
        </ul>
      </nav>
    <?php } else { ?>
      <p class="msg"><?php echo T_("No comment has registered yet!"); ?></p>
    <?php } //endif ?>
  </div>

</div>
