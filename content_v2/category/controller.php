<?php
namespace content_v2\category;


class controller
{
	public static function routing()
	{
		\content_v2\tools::invalid_url();
	}


	public static function api_routing()
	{
		$detail    = [];

		\content_v2\tools::apikey_required();

		$dir_2 = \dash\url::dir(2);

		if($dir_2 !== 'category')
		{
			\content_v2\tools::invalid_url();
		}


		$dir_3 = \dash\url::dir(3);
		$category_id = \dash\url::dir(3);

		if($dir_3 === 'add')
		{
			if(\dash\url::dir(4))
			{
				\content_v2\tools::invalid_url();
			}

			\content_v2\category\add::route_add();
		}
		elseif($dir_3 === 'list')
		{
			\content_v2\category\datalist::route();
		}
		elseif(is_numeric($category_id) && intval($category_id) > 0 && !\dash\number::is_larger($category_id, 9999999999))
		{

			switch (\dash\url::dir(4))
			{
				case 'child':
					if(\dash\url::dir(5))
					{
						\content_v2\tools::invalid_url();
					}
					\content_v2\category\datalist::route_child($category_id);
					break;

				case 'property':
					if(\dash\url::dir(5))
					{
						\content_v2\tools::invalid_url();
					}
					\content_v2\category\property::route($category_id);
					break;

				// case 'edit':
				// 	if(\dash\url::dir(5))
				// 	{
				// 		\content_v2\tools::invalid_url();
				// 	}
				// 	\content_v2\category\add::route_edit($category_id);
				// 	break;

				case null:
					\content_v2\category\get::route($category_id);
					break;

				default:
					\content_v2\tools::invalid_url();
					break;
			}
		}
		else
		{
			\content_v2\tools::invalid_url();
		}

	}


}
?>