<?php
namespace content_a\product\property;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Product properties!'). ' | '. \dash\data::dataRow_title());
		\dash\data::page_desc(T_('This property is show on the website page of this product'));
		\dash\data::page_pictogram('list-1');

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());

		$dataRow = \dash\data::dataRow();

		if(isset($dataRow['cat_id']))
		{
			$cat_id = $dataRow['cat_id'];
			$cat = \lib\app\product\cat::get($cat_id);

			if(isset($cat['defaultproperty']))
			{
				\dash\data::defaultproperty($cat['defaultproperty']);
			}
		}
		$peropertyList = \lib\app\property::product(\dash\request::get('id'));

		\dash\data::peropertyList($peropertyList);

		$autoList = \lib\app\property::autoList();
		\dash\data::autoList($autoList);

		if(\dash\request::get('pid'))
		{
			$load = \lib\app\property::get(\dash\request::get('pid'));
			\dash\data::pDataRow($load);
		}
	}
}
?>
