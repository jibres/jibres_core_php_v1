<?php
namespace lib\app\sms_charge;

class search
{

	private static $is_filtered = false;


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args)
	{
		$condition =
			[
				'order'          => 'order',
				'sort'           => filter::sort_enum(),
				'calculate_cost' => 'y_n',
				'store_id'       => 'id',
				'status'         => [
					'enum' => [
						'pending', 'moneylow', 'sending', 'send', 'delivered', 'queue', 'failed', 'undelivered',
						'cancel', 'block',
						'other',
					],
				],
				// 'type'      => ['enum' => []],
				'mobile'         => 'mobile',
			];


		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and          = [];
		$meta         = [];
		$or           = [];
		$param        = [];
		$meta['join'] = [];
		$meta['limit'] = 20;
		$order_sort = null;

		if($data['store_id'])
		{
			$and[]              = " sms_charge.store_id = :store_id";
			$param[':store_id'] = $data['store_id'];
			self::$is_filtered  = true;
		}




		$query_string = \dash\validate::search($_query_string, false);




		if($data['sort'] && !$order_sort)
		{
			if(\lib\app\sms\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort = " ORDER BY $data[sort] $data[order]";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY sms_charge.id DESC";
		}

		$list = \lib\db\sms_charge\search::list($param, $and, $or, $order_sort, $meta);


		if(!is_array($list))
		{
			$list = [];
		}

		return $list;
	}


}

?>