<?php
namespace lib\app\menu;


class generate
{


	public static function admin($_menu, $_option = [])
	{
		if(!is_array($_menu))
		{
			return null;
		}

        if(!is_array($_option))
        {
            $_option = [];
        }

        $defaul_option =
        [
            'subaddtitle'   => T_("Add Subitem"),
            'sublink'       => \dash\url::that(). '/item',
            'sublink_args'  => [],
            'editlink'      => \dash\url::that(). '/item',
            'editlink_args' => [],
        ];

        $_option = array_merge($defaul_option, $_option);

		$result = '';
		$result .= '<ol class="items2" data-layer-limit="4" data-sortable>';
		$result .= self::create_admin($_menu, $_option);
		$result .= '</ol>';

		return $result;

	}


	private static function create_admin($_menu, $_option = [])
	{
        $result = '';

		foreach ($_menu as $index => $one_item)
		{
            $have_child = false;

			if(isset($one_item['child']) && is_array($one_item['child']) && $one_item['child'])
            {
                $have_child = true;
            }

			$result .= '<li>';
			$result .= '<div class="f item">';
            {
    			// $result .= '<i class="sf-thumbnails sortHandle" data-handle>';
       //          {
       //          }
       //          $result .= '</i>';
                $result .= \dash\utility\icon::bootstrap('Grip horizontal', 'sortHandle');
                $result .= '<input type="hidden" name="sort[]" data-id="'. a($one_item, 'id'). '">';

                // $result .= '<i data-kerkere=".showMenu" data-kerkere-icon="open"></i>';

    			$result .= '<div class="key">'. a($one_item, 'title');
    			if(a($one_item, 'target'))
    			{
    				$result .= '<i class="sf-external-link fc-mute"></i>';
    			}
    			$result .= '</div>';

    			$result .= '<div class="value addChild pRa20-f s0">';
                {

                    $sublink_args = array_merge(['id' => a($one_item, 'parent1'), 'edit' => a($one_item, 'id')], $_option['sublink_args']);

                    $result .= '<a href="'. $_option['sublink'] .'?'. \dash\request::build_query($sublink_args). '">'. $_option['subaddtitle']. '</a>';
                }
                $result .= '</div>';

    			$result .= '<div class="value">';
                {
                    $editlink_args = array_merge(['id' => a($one_item, 'parent1'), 'edit' => a($one_item, 'id')], $_option['editlink_args']);

                    $result .= '<a href="'. $_option['editlink'] .'?'. \dash\request::build_query($editlink_args). '">'. T_("Edit"). '</a>';
                }
                $result .= '</div>';
            }
			$result .= '</div>';

            if($have_child)
			{
				$result .= '<ol data-sortable>';
				$result .= self::create_admin($one_item['child'], $_option);
				$result .='</ol>';
			}
			else
			{
				$result .= '<ol data-sortable></ol>';
			}

			$result .= '</li>';
		}

        return $result;
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
            // loop to create list item
            $result .= self::menuLi($load_menu['list'], 1);

            $result .= '</nav>';
        }

        return $result;
    }

    private static function menuLi($_list, $_layer)
    {
        if($_layer > 5)
        {
            return null;
        }
        $menuLi = '';
        $menuLi .= '<ul>';
        foreach ($_list as $myLiData)
        {
            $menuLi .= '<li data-test='. a($myLiData, 'id'). '>';
            {
                $menuLi .= self::menuLink(a($myLiData, 'title'), a($myLiData, 'url'), a($myLiData, 'target'));
                if(isset($myLiData['child']) && count($myLiData['child']))
                {
                    $menuLi .= self::menuLi($myLiData['child'], $_layer + 1);
                }
            }
            $menuLi .= '</li>';
        }
        $menuLi .= '</ul>';
        return $menuLi;
    }

    private static function menuLink($_text, $_link = null, $_target = null)
    {
        $menuLinkEl = '<a';
        if($_target)
        {
            $menuLinkEl .= ' target="_blank"';
        }
        if($_link)
        {
            $menuLinkEl .= ' href="'. $_link. '"';
        }
        $menuLinkEl .= '>';
        $menuLinkEl .= $_text;
        $menuLinkEl .= '</a>';

        return $menuLinkEl;
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