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
		if(!\lib\user::id())
		{
			return false;
		}


		if(!\lib\store::id())
		{
			return false;
		}

		$default_option =
		[
			'order' => null,
			'sort'  => null,
			'type'  => null,
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
		$field['store_id'] = \lib\store::id();

		if($_option['type'])
		{
			$field['type']     = $_option['type'];
		}

		unset($_option['type']);

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
