<?php
namespace lib\app\store;

trait datalist
{

	/**
	 * Gets the store.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The store.
	 */
	public static function list($_string = null, $_args = [])
	{
		if(!\dash\user::id())
		{
			return false;
		}

		$result          = \lib\db\stores::search($_string, $_args);
		$temp            = [];
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


	public static function where_i_am()
	{
		$user_id = \dash\user::id();
		$list    = \lib\db\userstores::where_i_am($user_id);
		$temp    = [];

		if(is_array($list))
		{
			foreach ($list as $key => $value)
			{
				$value = \lib\app\thirdparty::ready($value);
				$value = \lib\app\store::ready($value);

				$daysleft = null;

				$start    = $value['startplan'];
				$end      = $value['expireplan'];

				if($end)
				{
					$date1    = date_create(date("Y-m-d"));
					$date2    = date_create($end);
					$diff     = date_diff($date1,$date2);

					$daysleft = $diff->format("%r%a");

					if(intval($daysleft) < 0)
					{
						$daysleft = 0;
					}

					$daysleft = abs(intval($daysleft));

				}

				$t =
				[
					'customer'     => $value['customer'] ? true : false,
					'supplier'     => $value['supplier'] ? true : false,
					'staff'      => $value['staff'] ? true : false,
					'is_creator'  => $value['is_creator'] ? true : false,
					'url'         => \dash\url::protocol(). '://'. $value['slug']. '.'. \dash\url::domain(),
					'daysleft'    => $daysleft,
				];

				$temp[] = array_merge($value, $t);
			}
		}

		return $temp;
	}
}
?>