<?php
namespace content_api\v2\product;


class controller
{
	public static function routing()
	{
		\content_api\v2::invalid_url();
	}


	public static function api_routing()
	{
		$detail    = [];

		\content_api\v2::check_apikey();

		$dir_2 = \dash\url::dir(2);

		if($dir_2 === 'product')
		{
			$dir_3 = \dash\url::dir(3);

			switch ($dir_3)
			{
				case 'add':
					if(\dash\url::dir(4))
					{
						\content_api\v2::invalid_url();
					}

					\content_api\v2\product\add::route();
					break;

				default:
					$product_id = \dash\url::dir(3);

					if(is_numeric($product_id) && intval($product_id) > 0 && !\dash\number::is_larger($product_id, 9999999999))
					{
						switch (\dash\url::dir(4))
						{
							case 'comment':
								# code...
								break;

							case null:
								\content_api\v2\product\get::route($product_id);
								break;

							default:
								\content_api\v2::invalid_url();
								break;
						}
					}
					else
					{
						\content_api\v2::invalid_url();
					}
					break;
			}
		}
		else
		{
			\content_api\v2::invalid_url();
		}

		// if($dir === 'v2/product/unit')
		// {
		// 	\content_api\v2::check_apikey();
		// 	$detail = \content_api\v2\product\unit::route();
		// }
		// elseif($dir === 'v2/product/company')
		// {
		// 	\content_api\v2::check_apikey();
		// 	$detail = \content_api\v2\product\company::route();
		// }
		// elseif($dir === 'v2/product/comment')
		// {
		// 	// need less to check user
		// 	$detail = \content_api\v2\product\comment::route();
		// }
		// elseif($dir === 'v2/product/add')
		// {
		// 	// need less to check user
		// 	$detail = \content_api\v2\product\add::route();
		// }
		// elseif($dir === 'v2/product')
		// {
		// 	\content_api\v2::check_store_init();
		// 	$detail = \content_api\v2\product\get::route();
		// }
		// else
		// {
		// 	\content_api\v2::invalid_url();
		// }



	}


}
?>