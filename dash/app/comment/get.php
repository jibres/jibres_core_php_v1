<?php
namespace dash\app\comment;

class get
{
/**
	 * Gets the user.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The user.
	 */
	public static function get($_id)
	{
		\dash\permission::access('cmsCommentView');

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid comments id"));
			return false;
		}

		$detail = \dash\db\comments\get::full_by_id($id);

		$temp = [];

		if(is_array($detail))
		{
			$temp = \dash\app\comment\ready::row($detail);
		}

		return $temp;
	}


	public static function inline_get($_id)
	{


		$id = \dash\validate::id($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid comments id"));
			return false;
		}

		$detail = \dash\db\comments\get::by_id($id);

		if(!is_array($detail))
		{
			$detail = [];
		}

		return $detail;
	}


	public static function answer_count($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid comments id"));
			return false;
		}

		$answer_count = \dash\db\comments\get::answer_count($id);
		return floatval($answer_count);

	}


	public static function product_customer_review($_product_id)
	{
		$product_id = \dash\validate::id($_product_id);

		if(!$product_id)
		{
			return false;
		}

		$product_detail = \lib\app\product\get::inline_get($product_id);
		if(!$product_detail)
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$customer_review = \dash\db\comments\get::customer_review($product_id);
		if(!is_array($customer_review))
		{
			$customer_review = [];
		}

		$result =
		[
			'count'  => null,
			'avg'    => null,
			'star_1' => null,
			'star_2' => null,
			'star_3' => null,
			'star_4' => null,
			'star_5' => null,
		];

		$result = array_merge($result, $customer_review);

		$count = floatval($result['count']);
		if(!$count)
		{
			$count = 1;
		}
		$result['avg'] = round($result['avg'], 1);
		$result['star_1_percent'] = round((floatval($result['star_1']) * 100) / $count);
		$result['star_2_percent'] = round((floatval($result['star_2']) * 100) / $count);
		$result['star_3_percent'] = round((floatval($result['star_3']) * 100) / $count);
		$result['star_4_percent'] = round((floatval($result['star_4']) * 100) / $count);
		$result['star_5_percent'] = round((floatval($result['star_5']) * 100) / $count);

		return $result;
	}


	public static function product_comment_count($_product_id)
	{
		$product_id = \dash\validate::id($_product_id);
		if(!$product_id)
		{
			return false;
		}

		$load_count = \dash\db\comments\get::product_comment_count($product_id);

		if(!is_numeric($load_count))
		{
			$load_count = 0;
		}

		return intval($load_count);


	}


}
?>