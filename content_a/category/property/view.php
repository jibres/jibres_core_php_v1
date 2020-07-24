<?php
namespace content_a\category\property;

class view
{
	public static function config()
	{
		\dash\face::title(T_('General property'));

		if(\dash\data::dataRow_title())
		{
			\dash\face::title(\dash\data::dataRow_title());
		}

		$id = \dash\request::get('id');

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. $id);

		\dash\face::btnView(\dash\data::dataRow_url());

		$catList = \lib\app\product\property::property_cat_name($id, \dash\data::dataRow_properties());
		\dash\data::catList($catList);

		$keyList = \lib\app\product\property::property_key_name($id, \dash\data::dataRow_properties());
		\dash\data::keyList($keyList);

	}
}
?>