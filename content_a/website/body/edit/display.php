<section class="f" data-option='website-body-status-line'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Choose body line status");?></h3>
      <div class="body">
        <p><?php echo T_("If you want do disable for some time this line click here");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a href="<?php echo \dash\url::here(). '/setting/general' ?>" class="btn primary txtC"><?php echo T_("Change business description") ?></a>
    </div>
  </form>
</section>

<?php
if(is_array(\dash\data::lineOption_contain()))
{
  foreach (\dash\data::lineOption_contain() as $box => $box_detail)
  {
    if(is_string($box))
    {
      if(is_array($box_detail))
      {
        $addr = root. 'content_a/website/body/box/'. $box. '.php';
        if(is_file($addr))
        {
          require_once($addr);
        }
      }
    }
  }
}
?>