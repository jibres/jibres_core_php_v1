<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">
    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts">
            <div class="key"><?php echo T_('Posts');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_post()); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts?subtype=standard">
            <div class="key"><?php echo T_('standard post');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_standard()); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts?subtype=video">
            <div class="key"><?php echo T_('video post');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_video()); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::here();?>/posts?subtype=gallery">
            <div class="key"><?php echo T_('gallery post');?></div>
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
              <div class="key"><?php echo T_('Comments');?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_comments()); ?></div>
              <div class="go"></div>
            </a>
          </li>
          <li>
            <a class="item f" href="<?php echo \dash\url::here();?>/posts?status=awaiting">
              <div class="key"><?php echo T_('awaiting comments');?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_comments_awaiting()); ?></div>
              <div class="go"></div>
            </a>
          </li>
          <li>
            <a class="item f" href="<?php echo \dash\url::here();?>/posts?status=approved">
              <div class="key"><?php echo T_('approved comments');?></div>
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
<div class="f">
  <div class="c s12">
    <div class="pRa5">
      <div class="cbox fs11 mB10">
        <h2><?php echo T_("Latest News"); ?></h2>
        <?php if(is_array(\dash\data::dashboardDetail_latesPost())) {?>
          <?php foreach (\dash\data::dashboardDetail_latesPost() as $key => $value) {?>
            <a class="msg f" target="_blank" href="<?php echo a($value, 'link'); ?>">
              <div><?php if(isset($value['title']) && $value['title']) { echo $value['title']; } else { echo T_("Without title");} ?></div>
              <div class="cauto"><?php echo \dash\fit::date_human(a($value, 'datecreated')); ?></div>
            </a>
          <?php }//endfor ?>
        <?php }//endif ?>
      </div>
    </div>
  </div>
  <div class="c s12">
    <div class="pRa5">
      <div class="cbox fs11 mB10">
        <h2><?php echo T_("Latest comment"); ?></h2>
        <?php if(is_array(\dash\data::dashboardDetail_latesComment())) {?>
          <?php foreach (\dash\data::dashboardDetail_latesComment() as $key => $value) {?>
            <a class="msg f" href="<?php echo \dash\url::kingdom(); ?>/comment/<?php echo a($value, 'url'); ?>">
              <div><?php if(isset($value['title']) && $value['title']) { echo $value['title']; } else { echo T_("Without title");} ?></div>
              <div class="cauto"><?php echo \dash\fit::date_human(a($value, 'datecreated')); ?></div>
            </a>
          <?php }//endfor ?>
        <?php }//endif ?>
      </div>
    </div>
  </div>
</div>