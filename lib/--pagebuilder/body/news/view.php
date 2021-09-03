<?php
$lineSetting = \dash\data::lineSetting();

if(!\lib\pagebuilder\tools\tools::in('view'))
{
?>
<section class="f" data-option='website-line-design'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Setup design");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <a class="btn master" href="<?php echo \dash\url::current(). '/view'. \dash\request::full_get(); ?>"><?php echo T_("Setup design") ?></a>
      </div>
  </div>
</section>

<?php } ?>