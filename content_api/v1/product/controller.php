<?php
namespace content_api\v1\product;


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

		if($dir_2 !== 'product')
		{
			\content_api\v1::invalid_url();
		}


		$dir_3 = \dash\url::dir(3);
		$product_id = \dash\url::dir(3);

		if($dir_3 === 'add')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1::invalid_url();
			}

			\dash\permission::access('ProductAdd');

			\content_api\v1\product\action::route_add();
		}
		elseif(is_numeric($product_id) && intval($product_id) > 0 && !\dash\number::is_larger($product_id, 9999999999))
		{
			switch (\dash\url::dir(4))
			{
				case 'comment':

					break;

				case 'edit':
					\dash\permission::access('ProductEdit');

					if(\dash\url::dir(5))
					{
						\content_api\v1::invalid_url();
					}

					\content_api\v1\product\action::route_edit($product_id);
					break;

				case 'gallery':
					\dash\permission::access('ProductEdit');

					if(\dash\url::dir(5))
					{
						if(\dash\url::dir(5) === 'thumb')
						{
							if(\dash\url::dir(6))
							{
								\content_api\v1::invalid_url();
							}
							\content_api\v1\product\action::route_thumb($product_id);
						}
						else
						{
							\content_api\v1::invalid_url();
						}
					}

					\content_api\v1\product\action::route_gallery($product_id);
					break;

				case null:
					\content_api\v1\product\get::route($product_id);
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