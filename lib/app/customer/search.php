<?php
namespace lib\app\customer;


class search
{


	/**
	 * Gets the member.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The member.
	 */
	public static function list($_string = null, $_args = [])
	{
		if(!\dash\user::id() || !\lib\store::id())
		{
			return false;
		}

		$default_args =
		[
			'sort'      => null,
			'order'     => null,
			'type'      => null,
			'sort_type' => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_args, $_args);

		if($_args['sort'] && !in_array($_args['sort'], self::$sort_field))
		{
			$_args['sort'] = null;
		}

		$_args['store_id'] = \lib\store::id();

		if(!in_array($_args['type'], ['staff', 'customer', 'supplier']))
		{
			unset($_args['type']);
		}

		if(isset($_args['type']))
		{
			$_args[$_args['type']] = 1;
			unset($_args['type']);
		}


		if($_args['sort_type'] && !$_args['sort'])
		{
			switch ($_args['sort_type'])
			{
				case 'sale':
					$_args['order_raw'] = " users.customer DESC, users.staff DESC, users.id DESC ";
					break;
				case 'buy':
					$_args['order_raw'] = " users.supplier DESC, users.staff DESC, users.customer DESC, users.id DESC ";
					break;

				default:

					break;
			}
		}
		unset($_args['sort_type']);

		$result            = \dash\db\users::search(null, null, null, null);

		$temp              = [];

		foreach ($result as $key => $value)
		{
			$check = \lib\app\customer\ready::row($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}
}
?>