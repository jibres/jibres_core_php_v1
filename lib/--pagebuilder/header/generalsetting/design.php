<?php
$lineSetting = \dash\data::lineSetting();

if(!\lib\pagebuilder\tools\tools::in('generalsetting'))
{
?>
<section class="f" data-option='website-header-upload-logo'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo \lib\store::detail('title');?></h3>

      <div class="body">
        <p><?php echo \lib\store::detail('desc');?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a href="<?php echo \dash\url::here(). '/setting/general' ?>" class="btn primary txtC"><?php echo T_("Business Branding") ?></a>
    </div>
  </form>
</section>

<?php } ?>