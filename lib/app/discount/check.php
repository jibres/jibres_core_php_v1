<?php
namespace lib\app\discount;


class check
{

	public static function variable($_args, $_id = null)
	{

		$condition =
		[

			'code'            => 'username',
			'type'            => ['enum' => ['percentage','fixed_amount', 'free_shipping', 'buy_x_get_y', 'automatic']],
			'minrequirements' => ['enum' => ['none','amount', 'quantity']],
			'percentage'      => 'percent',
			'fixedamount'     => 'price',
			'maxamount'       => 'price',
			'minpurchase'     => 'price',
			'minquantity'     => 'int',
			'startdate'       => 'date',
			'starttime'       => 'time',
			'enddate'         => 'date',
			'endtime'         => 'time',
			'applyto'         => ['enum' => ['all_products','special_category', 'special_products']],
			'freeshipping'    => ['enum' => ['all','special_country', 'special_province', 'special_city', 'other']],
			'customer'        => ['enum' => ['everyone','special_customer_group', 'special_customer']],

			'usagetotal'      => 'int',
			'usageperuser'    => 'int',

			// 'creator'      => '',
			// 'datecreated'  => '',
			// 'datemodified' => '',
			// 'datefirstuse' => '',
			// 'datefinish'   => '',

			'status'          => ['enum' => ['draft','enable','disable','deleted','expire','blocked']],
			'usagestatus'     => ['enum' => ['used','full']],
			'desc'            => 'desc',
			'msgsuccess'      => 'desc',

		];

		$require = ['code'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		 var_dump($data);exit;

		$data['startdate'] = $data['startdate']. ' '. $data['starttime'];
		$data['enddate']   = $data['enddate']. ' '. $data['endtime'];

		unset($data['starttime']);
		unset($data['endtime']);

		return $data;

	}

}
?>