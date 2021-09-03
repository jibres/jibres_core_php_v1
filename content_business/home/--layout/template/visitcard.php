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

<?php require_once('socialnetwork.php'); ?>

      </div>

    </div>
  </div>
