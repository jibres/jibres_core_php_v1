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

		// $properties = \dash\data::dataRow_properties();

		// if($properties && is_array($properties))
		// {
		// 	if(count($properties) === 0)
		// 	{
		// 		array_push($properties, []);
		// 		array_push($properties, []);
		// 		array_push($properties, []);
		// 	}
		// 	elseif(count($properties) === 1)
		// 	{
		// 		array_push($properties, []);
		// 		array_push($properties, []);
		// 	}
		// 	elseif(count($properties) === 2)
		// 	{
		// 		array_push($properties, []);
		// 	}

		// 	// var_dump($properties);
		// }
		// else
		// {
		// 	\dash\data::dataRow_properties([[],[],[]]);
		// }

	}
}
?>