<?php
namespace content_v2\product;


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

		if($dir_2 !== 'product')
		{
			\content_v2\tools::invalid_url();
		}


		$dir_3 = \dash\url::dir(3);
		$product_id = \dash\url::dir(3);

		if($dir_3 === 'add')
		{
			if(\dash\url::dir(4))
			{
				\content_v2\tools::invalid_url();
			}

			\dash\permission::access('ProductAdd');

			\content_v2\product\action::route_add();
		}
		elseif(is_numeric($product_id) && intval($product_id) > 0 && !\dash\number::is_larger($product_id, 9999999999))
		{
			switch (\dash\url::dir(4))
			{
				case 'comment':
					if(\dash\url::dir(5) === 'add')
					{
						if(\dash\url::dir(6))
						{
							\content_v2\tools::invalid_url();
						}

						\content_v2\product\comment::route_add($product_id);
					}
					else
					{
						\content_v2\product\comment::route_get($product_id);
					}

					break;

				case 'edit':
					\dash\permission::access('ProductEdit');

					if(\dash\url::dir(5))
					{
						\content_v2\tools::invalid_url();
					}

					\content_v2\product\action::route_edit($product_id);
					break;

				case 'gallery':
					\dash\permission::access('ProductEdit');

					if(\dash\url::dir(5))
					{
						if(\dash\url::dir(5) === 'thumb')
						{
							if(\dash\url::dir(6))
							{
								\content_v2\tools::invalid_url();
							}
							\content_v2\product\action::route_thumb($product_id);
						}
						elseif(\dash\url::dir(5) === 'remove')
						{
							if(\dash\url::dir(6))
							{
								\content_v2\tools::invalid_url();
							}
							\content_v2\product\action::route_gallery_remove($product_id);
						}
						else
						{
							\content_v2\tools::invalid_url();
						}
					}

					\content_v2\product\action::route_gallery($product_id);
					break;

				case 'remove':
					if(\dash\url::dir(5))
					{
						\content_v2\tools::invalid_url();
					}
					\dash\permission::access('ProductDelete');
					\content_v2\product\action::route_remove($product_id);
					break;

				case 'property':
					if(\dash\url::dir(5))
					{
						\content_v2\tools::invalid_url();
					}
					\content_v2\product\property::route($product_id);

					break;

				case null:
					\content_v2\product\get::route($product_id);
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