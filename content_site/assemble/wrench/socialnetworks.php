<?php
namespace content_site\assemble\wrench;


class socialnetworks
{
  public static function type1($_social)
  {
    $html = '<nav class="social">';
    {
      if(a($social, 'linkedin', 'link'))
      {
        $html .= '<a target="_blank" href="'. a($social, 'linkedin', 'link') .'">';
        $html .= '<img src="'. \dash\url::cdn()'/business/visitcard-1/img/linkedin.svg" alt=""';
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/linkedin.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("linkedin"); ?>">
        $html .= '</a>';
      }
    }
    $html .= '</nav>';

  }
}

<?php $social = \lib\store::social(); ?>
        <div class="social">
<?php if(a($social, 'linkedin', 'user')) {?>
          <a target="_blank" href="<?php echo a($social, 'linkedin', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/linkedin.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("linkedin"); ?>">
          </a>
<?php } //endif ?>
<?php if(a($social, 'github', 'user')) {?>
          <a target="_blank" href="<?php echo a($social, 'github', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/github.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("github"); ?>">
          </a>
<?php } //endif ?>
<?php if(a($social, 'facebook', 'user')) {?>
          <a target="_blank" href="<?php echo a($social, 'facebook', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/facebook.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("facebook"); ?>">
          </a>
<?php } //endif ?>
<?php if(a($social, 'twitter', 'user')) {?>
          <a target="_blank" href="<?php echo a($social, 'twitter', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/twitter.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("twitter"); ?>">
          </a>
<?php } //endif ?>
<?php if(a($social, 'email', 'user')) {?>
          <a target="_blank" href="<?php echo a($social, 'email', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/arroba.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("Email"); ?>">
          </a>
<?php } //endif ?>
<?php if(a($social, 'instagram', 'user')) {?>
          <a target="_blank" href="<?php echo a($social, 'instagram', 'link'); ?>">
            <img src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/instagram.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("instagram"); ?>">
          </a>
<?php } // ?>
<?php if(a($social, 'telegram', 'user')) {?>
          <a target="_blank" href="<?php echo a($social, 'telegram', 'link'); ?>">
            <img class="telegram" src="<?php echo \dash\url::cdn() ?>/business/visitcard-1/img/telegram.svg" alt=" <?php echo \lib\store::title(). ' - '. T_("telegram"); ?>">
          </a>
<?php } // ?>

        </div>