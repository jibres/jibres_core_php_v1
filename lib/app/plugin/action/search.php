<?php
namespace lib\app\plugin\action;


class search
{
	public static function list($_query_string, $_args)
	{
		$condition =
		[
			'my_store_plugin_action'         => 'bit',
			'order'             => 'order',
			'sort'              => ['enum' => ['date', 'subprice', 'subtotal', 'subdiscount', 'item', 'qty','customer']],

			'customer'          => 'string',
			'user'          => 'string',
			'type'              => ['enum' => ['sale', 'buy', 'saleorder']],
			'product'           => 'id',
			'guestid'           => 'md5',

			'startdate'         => 'date',
			'enddate'           => 'date',
			'date'              => 'date',
			'time'              => 'time',
			'weekday'           => 'weekday',
			'pay'               => 'y_n',

			'discount_id'       => 'id',
			'subpricelarger'    => 'bigint',
			'subpriceless'      => 'bigint',
			'subpriceequal'     => 'bigint',
			'itemlarger'        => 'smallint',
			'itemless'          => 'smallint',
			'itemequal'         => 'smallint',
			'qtylarger'         => 'int',
			'qtyless'           => 'int',
			'qtyequal'          => 'int',
			'subtotallarger'    => 'bigint',
			'subtotalless'      => 'bigint',
			'subtotalequal'     => 'bigint',
			'subdiscountlarger' => 'bigint',
			'subdiscountless'   => 'bigint',
			'subdiscountequal'  => 'bigint',
			'subtotal'          => 'bigint',
			'limit'             => 'int',
			'get_unprocessed'   => 'bit',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and   = [];
		$param = [];
		$meta  = [];
		$or    = [];

		$join_factordetails = false;

		$order_sort         = null;

		if($data['limit'])
		{
			$meta['limit'] = $data['limit'];
		}




		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " factors.title LIKE :factors_query_search_string ";

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			$order_sort      = " ORDER BY $data[sort] $data[order] ";

		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY store_plugin_action.id DESC ";
		}


		$list = \lib\db\store_plugin_action\search::list($param, $and, $or, $order_sort, $meta);


		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\plugin\\action\\ready', 'row'], $list);



		return $list;
	}
}
?>