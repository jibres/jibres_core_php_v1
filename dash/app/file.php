<?php
namespace dash\app;


class file
{
	public static $sort_field =
	[
		'id',
		'user_id',
		'md5',
		'filename',
		'title',
		'desc',
		'usage',
		'type',
		'mime',
		'ext',
		'folder',
		'url',
		'path',
		'size',
		'status',
		'datecreated',
		'datemodified',
	];



	public static function multi_load($_ids)
	{
		if(!is_array($_ids))
		{
			return false;
		}

		$files = \dash\db\files::get_by_ids(implode(',', $_ids));
		if(is_array($files))
		{
			$files = array_map(['\\dash\\app\\file', 'ready'], $files);
		}

		return $files;
	}

	public static function get_inline($_id)
	{
		$id = $_id;
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			\dash\notif::error(T_("Id not set"));
			return false;
		}

		$result = \dash\db\files::get(['id' => $id, 'limit' => 1]);

		if(!$result)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		return $result;
	}


	public static function get($_id)
	{
		$result = self::get_inline($_get);

		if($result)
		{
			$result = self::ready($result);
		}

		return $result;
	}


	public static function list($_string = null, $_args = [])
	{

		if(!\dash\user::id())
		{
			return false;
		}

		$default_args =
		[
			'order' => null,
			'sort'  => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$option = [];
		$option = array_merge($default_args, $_args);

		if($option['order'])
		{
			if(!in_array($option['order'], ['asc', 'desc']))
			{
				unset($option['order']);
			}
		}

		if($option['sort'])
		{
			if(!in_array($option['sort'], self::$sort_field))
			{
				unset($option['sort']);
			}
		}

		$field             = [];

		$result = \dash\db\files::search($_string, $option, $field);

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



	/**
	 * ready data of user to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$result = [];

		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'user_id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'path':
					$value = \lib\filepath::fix($value);
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}

}
?>