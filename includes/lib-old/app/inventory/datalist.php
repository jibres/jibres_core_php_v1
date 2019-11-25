<?php
namespace lib\app\inventory;


trait datalist
{

	public static $sort_field =
	[
		'id',
		'code',
		'firstname',
		'lastname',
		'birthday',
		'mobile',
		'gender',
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


		unset($_args['sort_type']);

		$result            = \lib\db\inventory::search($_string, $_args);

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