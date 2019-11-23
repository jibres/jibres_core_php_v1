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

		\content_api\v1::check_apikey();

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

			\content_api\v1\product\add::route_add();
		}
		elseif(is_numeric($product_id) && intval($product_id) > 0 && !\dash\number::is_larger($product_id, 9999999999))
		{
			switch (\dash\url::dir(4))
			{
				case 'comment':
					# code...
					break;

				case 'edit':
					if(\dash\url::dir(5))
					{
						\content_api\v1::invalid_url();
					}
					\content_api\v1\product\add::route_edit($product_id);
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



		// if($dir === 'v1/product/unit')
		// {
		// 	\content_api\v1::check_apikey();
		// 	$detail = \content_api\v1\product\unit::route();
		// }
		// elseif($dir === 'v1/product/company')
		// {
		// 	\content_api\v1::check_apikey();
		// 	$detail = \content_api\v1\product\company::route();
		// }
		// elseif($dir === 'v1/product/comment')
		// {
		// 	// need less to check user
		// 	$detail = \content_api\v1\product\comment::route();
		// }
		// elseif($dir === 'v1/product/add')
		// {
		// 	// need less to check user
		// 	$detail = \content_api\v1\product\add::route();
		// }
		// elseif($dir === 'v1/product')
		// {
		// 	\content_api\v1::check_store_init();
		// 	$detail = \content_api\v1\product\get::route();
		// }
		// else
		// {
		// 	\content_api\v1::invalid_url();
		// }



	}


}
?>