<?php
$lineSetting = \dash\data::lineSetting();

if(!\lib\pagebuilder\tools\tools::in('change'))
{
?>
<section class="f" data-option='website-change-header'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Your Current Header Template");?> <b class="fc-green"><?php echo \dash\data::lineSetting_title(); ?></b></h3>
      <div class="body">
        <p><?php echo T_("You can change design of your header completely. We allow you full personalization. Design and build your own high-quality websites."); ?> </p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::current(). '/change'. \dash\request::full_get();?>"><?php echo T_("Change Header Template") ?></a>
    </div>
  </div>
</section>
<?php

}
else
{

  \dash\data::pagebuilderMode('header');

  \dash\data::lineList(\lib\pagebuilder\tools\add::header_list());

  require_once (root. '/content_a/pagebuilder/choose/display.php');
}

?>