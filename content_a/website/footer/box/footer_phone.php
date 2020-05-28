<?php $currentMenuID = null; $currentMenuName = null; ?>

<section class="f" data-option='website-footer-phone'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo \dash\get::index($box_detail, 'title');?></h3>
      <div class="body">
        <p><?php
$desc = \dash\get::index($box_detail, 'desc');
if($desc)
{
  echo $desc;
}
else
{
  echo T_("Main Text for footer");
}
?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action">
      <a href="<?php echo \dash\url::that(); ?>/phone" class="btn primary"><?php echo T_("Customize footer text") ?></a>
    </div>
  </form>
</section>
