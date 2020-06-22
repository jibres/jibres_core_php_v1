<?php
namespace lib\app\product;


class bullet
{
	public static function add($_args, $_id)
	{
		$condition =
		[
			'bullet'          => 'string_300',
		];

		$require = ['bullet'];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		\dash\permission::access('productEdit');


		$product_detail = \lib\app\product\get::inline_get($_id);

		if(!$product_detail || !isset($product_detail['id']))
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$bullet = [];
		if(isset($product_detail['bullet']))
		{
			$bullet = json_decode($product_detail['bullet'], true);
			if(!is_array($bullet))
			{
				$bullet = [];
			}
		}


		$bullet[] = ['text' => $data['bullet']];

		$bullet = json_encode($bullet, JSON_UNESCAPED_UNICODE);

		$update = \lib\db\products\update::record(['bullet' => $bullet], $_id);

		if($bullet)
		{
			\dash\notif::ok(T_("Product bullet saved"));
			return true;
		}

	}

}
?>