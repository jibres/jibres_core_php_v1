<?php
namespace lib\app\storetransaction;

trait datalist
{

	public static $sort_field =
	[
		'plus',
		'minus',
		'budget',
		'paytype',
		'date',
	];


	public static function active_list($_implode = false, $_retrun_all = false)
	{
		$result = \lib\db\storetransactions::get(['store_id' => \lib\store::id(), 'status' => 'enable']);
		if(is_array($result))
		{
			if(!$_retrun_all)
			{
				$result = array_column($result, 'title');
			}
		}

		if($_implode)
		{
			$result = implode(',', $result);
		}

		return $result;
	}

	/**
	 * Gets the storetransaction.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The storetransaction.
	 */
	public static function list($_string = null, $_args = [])
	{
		if(!\dash\user::id() || !\lib\store::id())
		{
			return false;
		}

		$default_meta =
		[
			'sort'  => null,
			'order' => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_meta, $_args);

		if($_args['sort'] && !in_array($_args['sort'], self::$sort_field))
		{
			$_args['sort'] = null;
		}

		$_args['storetransactions.store_id'] = \lib\store::id();

		$result            = \lib\db\storetransactions::search($_string, $_args);
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