<?php
namespace lib\app\thirdparty;


trait datalist
{

	public static $sort_field =
	[
		'id',
	];



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

		if(!$_args['type'])
		{
			unset($_args['type']);
		}

		if($_args['sort_type'] && !$_args['sort'])
		{
			switch ($_args['sort_type'])
			{
				case 'sale':
					$_args['order_raw'] = " userstores.customer DESC, userstores.staff DESC, userstores.id DESC ";
					break;
				case 'buy':
					$_args['order_raw'] = " userstores.supplier DESC, userstores.staff DESC, userstores.customer DESC, userstores.id DESC ";
					break;

				default:

					break;
			}
		}
		unset($_args['sort_type']);

		$result            = \lib\db\userstores::search($_string, $_args);

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