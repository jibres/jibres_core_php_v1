<?php
namespace content_api\v1\category;


class controller
{
	public static function routing()
	{
		\content_api\v1::invalid_url();
	}


	public static function api_routing()
	{
		$detail    = [];

		\content_api\v1::apikey_required();

		$dir_2 = \dash\url::dir(2);

		if($dir_2 !== 'category')
		{
			\content_api\v1::invalid_url();
		}


		$dir_3 = \dash\url::dir(3);
		$category_id = \dash\url::dir(3);

		if($dir_3 === 'add')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1::invalid_url();
			}

			\content_api\v1\category\add::route_add();
		}
		elseif($dir_3 === 'list')
		{
			\content_api\v1\category\datalist::route();
		}
		elseif($dir_3 === 'child')
		{
			\content_api\v1\category\datalist::route_child();
		}
		elseif(is_numeric($category_id) && intval($category_id) > 0 && !\dash\number::is_larger($category_id, 9999999999))
		{
			switch (\dash\url::dir(4))
			{

				// case 'edit':
				// 	if(\dash\url::dir(5))
				// 	{
				// 		\content_api\v1::invalid_url();
				// 	}
				// 	\content_api\v1\category\add::route_edit($category_id);
				// 	break;

				case null:
					\content_api\v1\category\get::route($category_id);
					break;

				default:
					\content_api\v1::invalid_url();
					break;
			}
		}
		else
		{
			\content_api\v1::invalid_url();
		}

	}


}
?>