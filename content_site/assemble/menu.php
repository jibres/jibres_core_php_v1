<?php
namespace content_site\assemble;


class menu
{

	/**
	 * based on wp menu creator
	 * https://developer.wordpress.org/reference/functions/wp_nav_menu/
	 * @param  [type] $_menu_id [description]
	 * @param  [type] $_arg     [description]
	 * @return [type]           [description]
	 */
	public static function generate($_menu_id, $_arg = null)
	{
		$load_menu = null;
		if(is_array($_menu_id))
		{
			// menu is passed
			$load_menu = $_menu_id;
		}
		else
		{
			$load_menu = \lib\app\menu\get::load_menu($_menu_id);
		}
		$html = null;

		if($load_menu)
		{
			$html = '<nav';
			if(a($_arg, 'nav_class'))
			{
				$html .= ' class="'. a($_arg, 'nav_class'). '"';
			}
			$html .= '>';
			// loop to create list item
			{
				// var_dump($load_menu);
				if($load_menu && is_array($load_menu['list']))
				{
					$html .= self::menuLi($load_menu['list'], 1, $_arg);
				}
			}
			$html .= '</nav>';
		}
		elseif(a($_arg, 'force_show_box'))
		{
			$html = '<div';
			if(a($_arg, 'nav_class'))
			{
				$html .= ' class="'. a($_arg, 'nav_class'). '"';
			}
			$html .= '>';
			$html .= '</div>';
		}

		return $html;
	}



	private static function menuLi($_list, $_layer, $_arg)
	{
		if($_layer > 5)
		{
			return null;
		}

		$menuLi = '<ul';
		if(a($_arg, 'ul_class'))
		{
			$menuLi .= ' class="'. a($_arg, 'ul_class'). '"';
		}
		$menuLi .= '>';

		foreach ($_list as $key => $myLiData)
		{
			$menuLi .= '<li';
			$menuLi .= ' data-layer="'. $_layer. '"';
			$menuLi .= ' data-key="'. $key. '"';

			if(a($_arg, 'li_class'))
			{
				$menuLi .= ' class="'. a($_arg, 'li_class'). '"';
			}
			$menuLi .= '>';
			{
				$menuLi .= self::menuLink(a($myLiData, 'title'), a($myLiData, 'url'), a($myLiData, 'target'), a($myLiData, 'icon'), $_arg);
				if(isset($myLiData['child']) && is_array($myLiData['child']) && count($myLiData['child']))
				{
					$menuLi .= self::menuLi($myLiData['child'], $_layer + 1, $_arg);
				}
			}
			$menuLi .= '</li>';
		}
		$menuLi .= '</ul>';
		return $menuLi;
	}


	private static function menuLink($_text, $_link, $_target, $_icon, $_arg)
	{
		$menuLinkEl = '<a';
		if($_target)
		{
			$menuLinkEl .= ' target="_blank"';
		}
		if(a($_arg, 'a_class'))
		{
			$menuLinkEl .= ' class="'. a($_arg, 'a_class'). '"';
		}
		if($_link)
		{
			$menuLinkEl .= ' href="'. $_link. '"';
		}

		$menuLinkEl .= '>';
    if($_icon)
    {
      if(a($_arg, 'a_iconGroup'))
      {
        $menuLinkEl .= \dash\utility\icon::svg($_icon, a($_arg, 'a_iconGroup'));
      }
      else
      {
        $menuLinkEl .= \dash\utility\icon::svg($_icon);
      }
    }

		$menuLinkEl .= $_text;
		$menuLinkEl .= '</a>';

		return $menuLinkEl;
	}
}
?>