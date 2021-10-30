<?php
namespace dash\layout\panelBuilder;

class sidebar
{
  public static function html()
  {
    // generate html of sidebar
    $myMenu = sidebarMenu::list0();
    $args = [];
    // generate menu
    $menuHTML = \content_site\assemble\menu::generate(null, $myMenu);

    return $menuHTML;
  }
}
?>