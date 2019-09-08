<?php
namespace content_a\product\lstock;


class view extends \content_a\product\home\view
{
	public static function config()
	{
		parent::config();

		\dash\data::page_title(T_('List of products'));

		$pageDesc = T_('You can search in list of products, add new product and edit existing.');
		// add back to product list link
		$pageDesc .= ' '. '<a href="'. \dash\url::this() .'/summary" data-shortkey="121">'. T_('Products dashboard'). '</a>';
		\dash\data::page_desc($pageDesc);
		\dash\data::page_pictogram('box');

	}
}
?>
