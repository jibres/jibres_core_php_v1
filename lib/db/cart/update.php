<?php
namespace lib\db\cart;


class update
{
	public static function assing_to_user($_guest_id, $_user_id)
	{
		$query  = "UPDATE cart SET cart.user_id = $_user_id, cart.guestid = NULL WHERE cart.guestid = '$_guest_id' ";
		$result = \dash\db::query($query);

		$merge_duplicate =
		"
			SELECT
				SUM(cart.count) AS `product_count`,
				MIN(cart.datecreated) AS `datecreated`,
				cart.product_id
			FROM
				cart
			WHERE
				cart.user_id = $_user_id
			GROUP BY cart.product_id
			HAVING COUNT(*) > 1
		";

		$have_duplicate = \dash\db::get($merge_duplicate);

		if($have_duplicate)
		{
			$querys = [];
			foreach ($have_duplicate as $key => $value)
			{
				$get_duplicate_query = "SELECT * FROM cart WHERE cart.user_id = $_user_id AND cart.product_id = $value[product_id] ";
				$get_duplicate = \dash\db::get($get_duplicate_query);
				foreach ($get_duplicate as $k => $v)
				{
					if($k === 0)
					{
						$querys[] = "UPDATE cart SET cart.count = $value[product_count] WHERE cart.id = $v[id] LIMIT 1";
					}
					else
					{
						$querys[] = "DELETE FROM cart WHERE cart.id = $v[id] LIMIT 1";
					}
				}
			}

			if(!empty($querys))
			{
				\dash\db::query(implode(";", $querys), null, ['multi_query' => true]);
			}
		}

		return $result;
	}

	public static function the_count($_product_id, $_user_id, $_count)
	{
		$query  = "UPDATE cart SET cart.count = $_count WHERE cart.product_id = $_product_id AND cart.user_id = $_user_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function the_count_guest($_product_id, $_guestid, $_count)
	{
		$query  = "UPDATE cart SET cart.count = $_count WHERE cart.product_id = $_product_id AND cart.guestid = '$_guestid' LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}




	public static function set_view_user_id($_user_id)
	{
		$query  = "UPDATE cart SET cart.view = 1 WHERE cart.user_id = $_user_id ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function set_view_guestid($_guestid)
	{
		$query  = "UPDATE cart SET cart.view = 1 WHERE cart.guestid = '$_guestid' ";
		$result = \dash\db::query($query);
		return $result;
	}






}
?>