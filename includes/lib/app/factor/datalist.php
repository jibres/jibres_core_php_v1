<?php
namespace lib\app\factor;

trait datalist
{

	public static $sort_field =
	[
		'title',
		'date',
		'detailsum',
		'detailtotalsum',
		'detaildiscount',
		'item',
		'qty',
		'customer',

	];


	/**
	 * Gets the factor.
	 *
	 * @param      <type>  $_option  The arguments
	 *
	 * @return     <type>  The factor.
	 */
	public static function list($_string = null, $_option = [])
	{
		if(!\dash\user::id())
		{
			return false;
		}


		if(!\lib\store::id())
		{
			return false;
		}

		$default_option =
		[
			'order'    => null,
			'sort'     => null,
			'type'     => null,
			'customer' => null,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		if($_option['order'])
		{
			if(!in_array($_option['order'], ['asc', 'desc']))
			{
				unset($_option['order']);
			}
		}

		if($_option['sort'])
		{
			if(!in_array($_option['sort'], self::$sort_field))
			{
				unset($_option['sort']);
			}
		}

		$field             = [];
		$field['factors.store_id'] = \lib\store::id();

		if($_option['type'])
		{
			$field['factors.type']     = $_option['type'];
		}

		if(!\dash\permission::check('factorAccess'))
		{
			return [];
		}

		if($_option['type'])
		{
			switch ($_option['type'])
			{
				case 'buy':
					if(!\dash\permission::check('factorBuyList'))
					{
						return [];
					}
					break;

				case 'sale':
					if(!\dash\permission::check('factorSaleList'))
					{
						return [];
					}
					break;
			}
		}
		else
		{
			$just_in  = [];

			if(\dash\permission::check('factorBuyList'))
			{
				array_push($just_in, "'buy'");
			}

			if(\dash\permission::check('factorSaleList'))
			{
				array_push($just_in, "'sale'");
			}

			if(!empty($just_in))
			{
				$just_in               = implode(',', $just_in);
				$field['factors.type'] = [" IN ", "($just_in)"];
			}
			else
			{
				return [];
			}
		}

		if($_option['customer'])
		{
			$customer_id = \dash\coding::decode($_option['customer']);
			if($customer_id)
			{
				$field['factors.customer']     = $customer_id;
			}
		}

		$result            = \lib\db\factors::search($_string, $_option, $field);
		$temp              = [];

		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}
}
?>
