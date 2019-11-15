<?php
namespace content_api\v1\product;


class controller
{
	public static function routing()
	{
		$detail    = [];

		$directory = \dash\url::directory();

		if($directory === 'v1/product/unit')
		{
			\content_api\v1::check_apikey();
			$detail = \content_api\v1\product\unit::route();
		}
		elseif($directory === 'v1/product/company')
		{
			\content_api\v1::check_apikey();
			$detail = \content_api\v1\product\company::route();
		}
		elseif($directory === 'v1/product/comment')
		{
			// need less to check user
			$detail = \content_api\v1\product\comment::route();
		}
		elseif($directory === 'v1/product/add')
		{
			// need less to check user
			$detail = \content_api\v1\product\add::route();
		}
		elseif($directory === 'v1/product')
		{
			\content_api\v1::check_store_init();
			$detail = \content_api\v1\product\get::route();
		}
		else
		{
			\content_api\v1::invalid_url();
		}

		\content_api\v1::say($detail);

	}


}
?>