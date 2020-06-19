<?php
namespace content_a\category\edit;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit category'));

		if(\dash\data::dataRow_title())
		{
			\dash\face::title(\dash\data::dataRow_title());
		}

		$id = \dash\request::get('id');

		\dash\data::back_text(T_('Categories'));
		\dash\data::back_link(\dash\url::this());

		$parent_property = \lib\app\category\get::parent_property($id);
		\dash\data::parentProperty($parent_property);

		$parentList = \lib\app\category\get::parent_list($id);
		\dash\data::parentList($parentList);

		\dash\face::btnView(\dash\data::dataRow_url());
		\dash\face::btnSave('form1');

		$properties = \dash\data::dataRow_properties();

		$count_free = 1;

		if($properties && is_array($properties))
		{
			if(count($properties) === 0)
			{
				$count_free = 3;
			}
			elseif(count($properties) === 1)
			{
				$count_free = 2;
			}
			elseif(count($properties) === 2)
			{
				$count_free = 2;
			}
		}
		else
		{
			$count_free = 3;
		}

		\dash\data::countFree($count_free);

	}
}
?>