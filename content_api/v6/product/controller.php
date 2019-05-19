<?php
namespace content_api\v6\product;


class controller
{
	public static function routing()
	{
		\content_api\v6\access::check();

		\content_api\v6\access::store();



		$detail    = [];

		$directory = \dash\url::directory();

		if($directory === 'v6/product/unit')
		{
			\content_api\v6\access::user();
			$detail = \content_api\v6\product\unit::route();
		}
		elseif($directory === 'v6/product/company')
		{
			\content_api\v6\access::user();
			$detail = \content_api\v6\product\company::route();
		}
		elseif($directory === 'v6/product/guarantee')
		{
			\content_api\v6\access::user();
			$detail = \content_api\v6\product\guarantee::route();
		}
		elseif($directory === 'v6/product/comment')
		{
			// need less to check user
			$detail = \content_api\v6\product\comment::route();
		}
		else
		{
			\content_api\v6::no(404);
		}

		\content_api\v6::bye($detail);

	}


}
?>