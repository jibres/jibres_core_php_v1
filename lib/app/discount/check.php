<?php
namespace lib\app\discount;


class check
{

	public static function variable($_args, $_id = null)
	{

		$condition =
		[

			'code'             => 'discount_code',
			'type'             => ['enum' => ['percentage','fixed_amount', 'free_shipping', 'buy_x_get_y', 'automatic']],
			'minrequirements'  => ['enum' => ['none','amount', 'quantity']],
			'percentage'       => 'percent',
			'fixedamount'      => 'price',
			'maxamount'        => 'price',
			'minpurchase'      => 'price',
			'minquantity'      => 'int',
			'startdate'        => 'date',
			'starttime'        => 'time',
			'enddate'          => 'date',
			'endtime'          => 'time',
			'applyto'          => ['enum' => ['all_products','special_category', 'special_products']],
			'freeshipping'     => ['enum' => ['all','special_country', 'special_province', 'special_city', 'other']],
			'customer'         => ['enum' => ['everyone','special_customer_group', 'special_customer']],

			'usagetotal'       => 'int',
			'usageperuser'     => 'bit', // maybe later set it as int. current

			// 'creator'       => '',
			// 'datecreated'   => '',
			// 'datemodified'  => '',
			// 'datefirstuse'  => '',
			// 'datefinish'    => '',

			'status'           => ['enum' => ['draft','enable','disable','deleted','expire','blocked']],
			'usagestatus'      => ['enum' => ['used','full']],
			'desc'             => 'desc',
			'msgsuccess'       => 'desc',

			'product_category' => 'tag',
			'special_products' => 'tag',
			'customer_group'   => 'string_100',
			'special_customer' => 'tag',
			'set_usagetotal'   => 'bit',
			'setenddate'       => 'bit',

		];

		$require = ['code'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['startdate'])
		{
			$data['startdate'] = date("Y-m-d");
		}

		if(!$data['starttime'])
		{
			$data['starttime'] = date("H:i");
		}

		$data['startdate'] = trim($data['startdate']. ' '. $data['starttime']);

		if($data['enddate'])
		{
			if(!$data['endtime'])
			{
				$data['endtime'] = date("H:i");
			}

			$data['enddate']   = trim($data['enddate']. ' '. $data['endtime']);
		}

		if(!$data['setenddate'])
		{
			$data['enddate'] = null;
		}

		if($data['startdate'] && $data['enddate'])
		{
			if(strtotime($data['enddate'])  < strtotime($data['startdate']))
			{
				\dash\notif::error(T_("Start date must be less than end date!"), ['element' => ['startdate', 'enddate', 'starttime', 'endtime']]);
				return false;
			}
		}

		if($data['status'] === 'enable')
		{
			// check some thing on enable discount code
			if($data['type'] === 'percentage' && !$data['percentage'])
			{
				\dash\notif::error(T_("Percentage is required"), 'percentage');
				return false;
			}

			if($data['type'] === 'fixed_amount' && !$data['fixedamount'])
			{
				\dash\notif::error(T_("Fixed amount is required"), 'fixedamount');
				return false;
			}


			if($data['minrequirements'] === 'amount' && !$data['minpurchase'])
			{
				\dash\notif::error(T_("Minimum purchase is required"), 'minpurchase');
				return false;
			}

			if($data['minrequirements'] === 'quantity' && !$data['minquantity'])
			{
				\dash\notif::error(T_("Minimum quantity is required"), 'minquantity');
				return false;
			}

		}

		if(!$data['set_usagetotal'])
		{
			$data['usagetotal'] = null;
		}

		unset($data['starttime']);
		unset($data['endtime']);
		unset($data['set_usagetotal']);
		unset($data['setenddate']);

		return $data;

	}

}
?>