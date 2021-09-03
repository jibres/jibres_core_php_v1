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
		$load_menu = \lib\app\menu\get::load_menu($_menu_id);

		$html = '<nav';
		if(a($_arg, 'nav_class'))
		{
			$html .= ' class="'. a($_arg, 'nav_class'). '"';
		}
		$html .= '>';
		// loop to create list item
		{
			$html .= self::menuLi($load_menu['list'], 1, $_arg);
		}
		$html .= '</nav>';

		return;
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
			$html .= ' class="'. a($_arg, 'ul_class'). '"';
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
				$menuLi .= self::menuLink(a($myLiData, 'title'), a($myLiData, 'url'), a($myLiData, 'target'));
				if(isset($myLiData['child']) && count($myLiData['child']))
				{
					$menuLi .= self::menuLi($myLiData['child'], $_layer + 1, $_arg);
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
}
?>