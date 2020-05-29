<?php
namespace content_a\category\edit;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit category'));

		\dash\data::back_text(T_('Category list'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::parentList(\lib\app\category\get::parent_list(\dash\request::get('id')));

		if(\dash\data::dataRow_title())
		{
			\dash\face::title(T_('Edit category'). ' | '. \dash\data::dataRow_title());
		}

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