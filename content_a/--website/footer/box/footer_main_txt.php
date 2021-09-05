<?php $currentMenuID = null; $currentMenuName = null; ?>

<section class="f" data-option='website-footer-main-txt'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo a($box_detail, 'title');?></h3>
      <div class="body">
        <p><?php
$desc = a($box_detail, 'desc');
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
      <a href="<?php echo \dash\url::that(); ?>/maintext" class="btn primary"><?php echo T_("Customize footer text") ?></a>
    </div>
  </form>
</section>