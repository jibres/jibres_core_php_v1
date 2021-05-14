<?php
namespace content_a\products\property;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		\dash\face::title(T_("Property"));


		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));



		if(\dash\data::productDataRow_url())
		{
			\dash\face::btnView(\dash\data::productDataRow_url());
		}


		$property_list = \lib\app\product\property::get_pretty($id, true);
		\dash\data::propertyList($property_list);


		$catList = \lib\app\product\property::all_cat_name();
		\dash\data::catList($catList);

		$keyList = \lib\app\product\property::all_key_name();
		\dash\data::keyList($keyList);

		$pid = \dash\request::get('pid');
		if($pid && isset($property_list['saved']) && is_array($property_list['saved']))
		{
			foreach ($property_list['saved'] as $key => $value)
			{
				if(isset($value['list']) && is_array($value['list']))
				{
					foreach ($value['list'] as $k => $v)
					{
						if(isset($v['id']) && $v['id'] == $pid)
						{
							if(isset($value['title']))
							{
								$v['cat'] = $value['title'];
							}
							\dash\data::dataRow($v);
							\dash\data::editMode(true);
							break;
						}
					}
				}
			}
		}
		else
		{
			$fill_product_property = \dash\session::get('fill_product_property');
			if($fill_product_property)
			{
				\dash\data::fillProductProperty($fill_product_property);
			}
		}
	}
}
?>
