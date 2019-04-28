<?php
namespace content_a\product;


class load
{
	public static function product()
	{
		if(!\dash\request::get('id'))
		{
			\dash\header::status(404, T_("Product id not set"));
		}

		$id = \dash\request::get('id');

		$result = \lib\app\product::get($id);
		if(!$result)
		{
			\dash\header::status(403, T_("Invalid product id"));
		}

		\dash\data::dataRow($result);


		$tag = \lib\db\producttermusages::usage(\dash\coding::decode($id));

		if($tag && is_array($tag))
		{
			\dash\data::tagRow($tag);
			\dash\data::tagValue(implode(',', array_column($tag, 'title')));
		}
	}



	public static function fixTitle()
	{
		$myName = \dash\data::dataRow_title();
		if($myName)
		{
			$myName = \dash\data::page_title(). ' | '. $myName;
			\dash\data::page_title($myName);
		}

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
