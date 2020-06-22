<?php
namespace lib\app\website\menu;

class generate
{

	public static function menu($_key, $_class = null)
	{
		$customized_key = '';
		if(in_array(substr($_key, 0, 6), ['header', 'footer']))
		{
			$customized_key = substr($_key, 0, 6);
		}

		$website = \dash\data::website();

		if(isset($website[$customized_key][$_key]) && isset($website['menu'][$website[$customized_key][$_key]]['list']) && is_array($website['menu'][$website[$customized_key][$_key]]['list']))
		{
  			echo '<nav';
  			if($_class)
  			{
  				echo ' class="'. $_class. '"';
  			}
  			echo '>';
     		foreach ($website['menu'][$website[$customized_key][$_key]]['list'] as $menuValue)
     		{
      			echo '<a ';
      			if(\dash\get::index($menuValue, 'target'))
      			{
      				echo 'target="_blank" data-direct ';
      			}
      			echo ' href="'. \dash\get::index($menuValue, 'url'). '">'. \dash\get::index($menuValue, 'title'). '</a>';
     		}
  			echo '</nav>';
		}
	}



  public static function have_header_menu()
  {
    $website = \dash\data::website();

    if(isset($website['header']) && is_array($website['header']))
    {
      if(
          (isset($website['header']['header_menu_1']) && $website['header']['header_menu_1']) ||
          (isset($website['header']['header_menu_2']) && $website['header']['header_menu_2'])

        )
      {
        return true;
      }
    }

    return false;
  }
}
?>