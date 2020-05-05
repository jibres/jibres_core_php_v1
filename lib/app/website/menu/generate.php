<?php
namespace lib\app\website\menu;

class generate
{

	public static function menu($_key)
	{
		$customized_key = '';
		if(in_array(substr($_key, 0, 6), ['header', 'footer']))
		{
			$customized_key = substr($_key, 0, 6) . '_customized';
		}

		$website = \dash\data::website();
		if(isset($website[$customized_key][$_key]) && isset($website['menu'][$website[$customized_key][$_key]]['list']) && is_array($website['menu'][$website[$customized_key][$_key]]['list']))
		{
  			echo '<nav>';
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
}
?>