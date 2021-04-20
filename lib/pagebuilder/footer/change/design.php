<?php
$lineSetting = \dash\data::lineSetting();

if(!\lib\pagebuilder\tools\tools::in('change'))
{
?>
<section class="f" data-option='website-change-footer'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Your Current Footer Template");?> <b class="fc-green"><?php echo \dash\data::lineSetting_title(); ?></b></h3>
      <div class="body">
        <p><?php echo T_("You can change design of your footer completely. We allow you full personalization. Design and build your own high-quality websites."); ?> </p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::that(). '/change'. \dash\request::full_get();?>"><?php echo T_("Change Footer Template") ?></a>
    </div>
  </div>
</section>
<?php

}
else
{

  \dash\data::pagebuilderMode('footer');

  \dash\data::lineList(\lib\pagebuilder\tools\add::footer_list());

  require_once (root. '/content_a/pagebuilder/choose/display.php');
}

?>