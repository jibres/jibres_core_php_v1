<?php
namespace content_a\category\property;

class view
{
	public static function config()
	{
		\dash\face::title(T_('General property'));


		$id = \dash\request::get('id');

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. $id);

		$catList = \lib\app\product\property::property_cat_name($id);
		\dash\data::catList($catList);

		$keyList = \lib\app\product\property::property_key_name($id);
		\dash\data::keyList($keyList);

		self::load_property();

		$fill_category_property = \dash\session::get('fill_category_property');
		if($fill_category_property)
		{
			\dash\data::fillCategoryProperty($fill_category_property);
		}


	}


	public static function load_property()
	{

		if(\dash\data::dataRow_properties() && is_array(\dash\data::dataRow_properties()))
		{
			$property = \dash\data::dataRow_properties();
			$list = [];
			foreach ($property as $key => $value)
			{
				if(isset($value['group']) && isset($value['key']))
				{
					if(!isset($list[$value['group']]))
					{
						$list[$value['group']] = [];
					}

					$list[$value['group']][$key] = $value['key'];
				}
			}

			\dash\data::propertyGroup($list);
		}
	}
}
?>