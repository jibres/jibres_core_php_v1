  <div class="visitBox row no-gutters">
    <div class="c-xs-12 c-sm-12 c-lg-auto">
      <img class="avatarImg" src="<?php echo \lib\store::logo() ?>" alt="<?php echo \lib\store::title(); ?>">
    </div>
    <div class="c-xs-12 c-sm-12 c-lg-auto">
      <div class="info">
        <h1><?php echo \lib\store::title(); ?></h1>
        <h2><?php echo \lib\store::desc(); ?></h2>

        <?php $social = \lib\store::social(); ?>

        <div class="social">
          <?php if(false) {?>
          <a href="">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/linkedin.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("linkedin"); ?>">
          </a>
          <a href="">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/github.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("github"); ?>">
          </a>
          <a href="">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/facebook.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("facebook"); ?>">
          </a>
          <a href="">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/twitter.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("twitter"); ?>">
          </a>
          <a href="">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/arroba.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("Email"); ?>">
          </a>
        <?php } //endif ?>

        <?php if(\dash\get::index($social, 'instagram')) {?>
          <a href="<?php echo \dash\get::index($social, 'instagram', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/instagram.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("instagram"); ?>">
          </a>
        <?php } // ?>

        <?php if(\dash\get::index($social, 'telegram')) {?>
          <a href="<?php echo \dash\get::index($social, 'telegram', 'link'); ?>">
            <img class="telegram" src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/telegram.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("telegram"); ?>">
          </a>
        <?php } // ?>

        </div>
      </div>

    </div>
  </div>
