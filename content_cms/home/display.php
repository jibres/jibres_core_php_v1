<nav class="items long2">
  <ul>
    <li>
      <a class="item f" href="<?php echo \dash\url::here();?>/posts">
        <div class="key"><?php echo T_('Posts');?></div>
        <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_news()); ?></div>
        <div class="go"></div>
      </a>
    </li>
    <li>
      <a class="item f" href="<?php echo \dash\url::here();?>/pages">
        <div class="key"><?php echo T_('Pages');?></div>
        <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_pages()); ?></div>
        <div class="go"></div>
      </a>
    </li>
    <li>
      <a class="item f" href="<?php echo \dash\url::here();?>/tag">
        <div class="key"><?php echo T_('Tags');?></div>
        <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_tags()); ?></div>
        <div class="go"></div>
      </a>
    </li>
    <?php if(\dash\permission::check('cmsAttachmentView')) {?>
      <li class="">
        <a class="item f" href="<?php echo \dash\url::here();?>/files">
          <div class="key"><?php echo T_('Attachments');?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_comments()); ?></div>
          <div class="go"></div>
        </a>
      </li>
    <?php }// endif ?>
    <?php if(\dash\permission::check('cmsCommentView')) {?>
      <li class="">
        <a class="item f" href="<?php echo \dash\url::here();?>/comments">
          <div class="key"><?php echo T_('Comments');?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_comments()); ?></div>
          <div class="go"></div>
        </a>
      </li>
    <?php }// endif ?>
    <?php if(!\dash\engine\store::inStore() && \dash\permission::check('cmsManageHelpCenter')) {?>
      <li class="">
        <a class="item f" href="<?php echo \dash\url::here();?>/help">
          <div class="key"><?php echo T_('Help center');?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_help()); ?></div>
          <div class="go"></div>
        </a>
      </li>
    <?php }// endif ?>
  </ul>
</nav>


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
        <?php if(is_array(\dash\data::dashboardDetail_comment())) {?>
          <?php foreach (\dash\data::dashboardDetail_comment() as $key => $value) {?>
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