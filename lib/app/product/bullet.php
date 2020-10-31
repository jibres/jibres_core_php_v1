<?php
namespace lib\app\product;


class bullet
{
	public static function set($_args, $_id, $_type, $_index = null)
	{
		$condition =
		[
			'bullet'          => 'string_300',
		];

		if($_type === 'add' || $_type === 'edit')
		{
			$require = ['bullet'];
		}
		else
		{
			$require = [];
		}

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		\dash\permission::access('ProductEdit');


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

		$new_bullet = ['text' => $data['bullet']];

		if($_type === 'add')
		{
			$bullet[] = $new_bullet;
		}
		else
		{
			if(!isset($bullet[$_index]))
			{
				\dash\notif::error(T_("Invalid bullet text index!"));
				return false;
			}

			if($_type === 'edit')
			{
				$bullet[$_index] = $new_bullet;
			}
			elseif($_type === 'remove')
			{
				unset($bullet[$_index]);
			}
			else
			{
				\dash\notif::error(T_("Invalid type"));
				return false;
			}

		}


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