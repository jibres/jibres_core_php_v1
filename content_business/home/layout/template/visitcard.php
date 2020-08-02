  <div class="visitBox row no-gutters<?php
    if (strlen(\lib\store::title()) > 20)
    {
      echo " wide";
    }
   ?>">
    <div class="c-xs-12 c-sm-12 c-lg-auto">
      <img class="avatarImg" src="<?php echo \lib\store::logo() ?>" alt="<?php echo \lib\store::title(); ?>">
    </div>
    <div class="c-xs-12 c-sm-12 c-lg">
      <div class="info">
        <h1><?php echo \lib\store::title(); ?></h1>
<?php if(\lib\store::desc()) {?>
        <h2><?php echo \lib\store::desc(); ?></h2>
<?php } ?>
<?php $social = \lib\store::social(); ?>
        <div class="social">
<?php if(\dash\get::index($social, 'linkedin')) {?>
          <a target="_blank" href="<?php echo \dash\get::index($social, 'linkedin', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/linkedin.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("linkedin"); ?>">
          </a>
<?php } //endif ?>
<?php if(\dash\get::index($social, 'github')) {?>
          <a target="_blank" href="<?php echo \dash\get::index($social, 'github', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/github.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("github"); ?>">
          </a>
<?php } //endif ?>
<?php if(\dash\get::index($social, 'facebook')) {?>
          <a target="_blank" href="<?php echo \dash\get::index($social, 'facebook', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/facebook.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("facebook"); ?>">
          </a>
<?php } //endif ?>
<?php if(\dash\get::index($social, 'twitter')) {?>
          <a target="_blank" href="<?php echo \dash\get::index($social, 'twitter', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/twitter.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("twitter"); ?>">
          </a>
<?php } //endif ?>
<?php if(\dash\get::index($social, 'email')) {?>
          <a target="_blank" href="<?php echo \dash\get::index($social, 'email', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/arroba.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("Email"); ?>">
          </a>
<?php } //endif ?>
<?php if(\dash\get::index($social, 'instagram')) {?>
          <a target="_blank" href="<?php echo \dash\get::index($social, 'instagram', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/instagram.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("instagram"); ?>">
          </a>
<?php } // ?>
<?php if(\dash\get::index($social, 'telegram')) {?>
          <a target="_blank" href="<?php echo \dash\get::index($social, 'telegram', 'link'); ?>">
            <img class="telegram" src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/telegram.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("telegram"); ?>">
          </a>
<?php } // ?>

        </div>
      </div>

    </div>
  </div>
