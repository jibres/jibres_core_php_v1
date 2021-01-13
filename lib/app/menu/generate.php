<?php
namespace lib\app\menu;


class generate
{
	private static $result = '';


	public static function admin($_menu)
	{
		if(!is_array($_menu))
		{
			return null;
		}

		self::$result = '';
		self::$result .= '<ol class="items2" data-layer-limit="4" data-sortable>';

		self::create_admin($_menu);

		self::$result .= '</ol>';


		return self::$result;

	}


	private static function create_admin($_menu)
	{
		foreach ($_menu as $index => $one_item)
		{
			self::$result .= '<li>';
			self::$result .= '<div class="f item">';
			self::$result .= '<i class="sf-thumbnails" data-handle><input type="hidden" name="sort[]" data-id="'. a($one_item, 'id'). '"></i>';
			self::$result .= '<div class="key">'. a($one_item, 'title');

			if(a($one_item, 'target'))
			{
				self::$result .= '<i class="sf-external-link fc-mute"></i>';
			}

			self::$result .= '</div>';
			self::$result .= '<div class="value addChild pRa20-f s0"><a href="'. \dash\url::that(). '/item?'. \dash\request::build_query(['id' => a($one_item, 'parent1'), 'parent' => a($one_item, 'id')]). '">'. T_("Add Subitem"). '</a></div>';
			self::$result .= '<div class="value"><a href="'. \dash\url::that(). '/item?'. \dash\request::build_query(['id' => a($one_item, 'parent1'), 'edit' => a($one_item, 'id')]). '">'. T_("Edit"). '</a></div>';
			self::$result .= '</div>';

			if(isset($one_item['child']) && is_array($one_item['child']) && $one_item['child'])
			{
				self::$result .= '<ol data-sortable>';
				self::create_admin($one_item['child']);
				self::$result .='</ol>';
			}
			else
			{
				self::$result .= '<ol data-sortable></ol>';
			}

			self::$result .= '</li>';
		}
	}




	public static function menu($_key, $_class = null)
	{
        $result = '';

		$customized_key = '';
		if(in_array(substr($_key, 0, 6), ['header', 'footer']))
		{
			$customized_key = substr($_key, 0, 6);
		}

		$website = \dash\data::website();

        if(isset($website[$customized_key][$_key]) && $website[$customized_key][$_key] && is_numeric($website[$customized_key][$_key]))
        {
            $menu_id = $website[$customized_key][$_key];

            $max_level = 1; // load maximum level
            $load_menu = \lib\app\menu\get::load_menu($menu_id, $max_level);

            if(!$load_menu)
            {
                return null;
            }

  			$result .= '<nav';
  			if($_class)
  			{
  				$result .= ' class="'. $_class. '"';
  			}
  			$result .= '>';
     		foreach ($load_menu['list'] as $menuValue)
     		{
      			$result .= '<a ';
      			if(a($menuValue, 'target'))
      			{
      				$result .= 'target="_blank" data-direct ';
      			}
      			$result .= ' href="'. a($menuValue, 'url'). '">'. a($menuValue, 'title'). '</a>';
     		}
  			$result .= '</nav>';
		}

        return $result;
	}



    public static function menu_with_title($_key, $_class = null)
    {

        $result = '';

        $customized_key = '';
        if(in_array(substr($_key, 0, 6), ['header', 'footer']))
        {
            $customized_key = substr($_key, 0, 6);
        }

        $website = \dash\data::website();

        if(isset($website[$customized_key][$_key]) && $website[$customized_key][$_key] && is_numeric($website[$customized_key][$_key]))
        {
            $menu_id = $website[$customized_key][$_key];

            $max_level = 1; // load maximum level
            $load_menu = \lib\app\menu\get::load_menu($menu_id, $max_level);

            if(!$load_menu)
            {
                return null;
            }

            if(isset($load_menu['title']))
            {
                $result .= '<h4>'. $load_menu['title']. '</h4>';
            }

            $result .= '<nav';
            if($_class)
            {
                $result .= ' class="'. $_class. '"';
            }
            $result .= '>';
            $result .= '<ul>';
            foreach ($load_menu['list'] as $menuValue)
            {
                $result .= '<li>';
                $result .= '<a ';
                if(a($menuValue, 'target'))
                {
                    $result .= 'target="_blank" data-direct ';
                }
                $result .= ' href="'. a($menuValue, 'url'). '">'. a($menuValue, 'title'). '</a>';
                $result .= '</li>';
            }
            $result .= '</ul>';
            $result .= '</nav>';
        }

        return $result;
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




    public static function have_footer_menu()
    {
        $website = \dash\data::website();

        if(isset($website['footer']) && is_array($website['footer']))
        {
            if(
                (isset($website['footer']['footer_menu_1']) && $website['footer']['footer_menu_1']) ||
                (isset($website['footer']['footer_menu_2']) && $website['footer']['footer_menu_2']) ||
                (isset($website['footer']['footer_menu_3']) && $website['footer']['footer_menu_3']) ||
                (isset($website['footer']['footer_menu_4']) && $website['footer']['footer_menu_4'])

                )
            {
                return true;
            }
        }

        return false;
    }

}
?>