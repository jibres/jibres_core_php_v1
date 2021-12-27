<?php
namespace dash\db;


class config
{



	/**
	 * Gets the count of users
	 * set $_type null to get all users by status and validstatus
	 *
	 * @param      <type>  $_type  The type
	 *
	 * @return     <type>  The count.
	 */
	public static function public_get_count($_table, $_where = null, $_db_name = true)
	{
		if(!$_table || !is_string($_table))
		{
			return false;
		}

		$query           = null;
		$field           = 'count';
		$only_one_record = true;

		if($_where)
		{
			$where = \dash\db\config::make_where($_where);
			if(!$where)
			{
				return false;
			}
			$query = "SELECT COUNT(*) AS 'count' FROM `$_table` WHERE $where ";
		}
		else
		{
			$query = "SELECT COUNT(*) AS 'count' FROM `$_table`";
		}

		if($query)
		{
			$result = \dash\pdo::get($query, [], $field, $only_one_record, $_db_name);
			return floatval($result);
		}
		return 0;
	}





	/**
	 * Makes a where.
	 *
	 * @param      <type>  $_where  The where
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	public static function make_where($_where, $_options = [])
	{
		$default_options =
		[
			'condition'  => 'AND',
			'table_name' => null,
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		$table_name = null;
		if($_options['table_name'])
		{
			$table_name = "`$_options[table_name]`.";
		}

		if(!is_array($_where))
		{
			$_where = [];
		}

		$where = [];
		foreach ($_where as $field => $value)
		{
			$my_field = "$table_name`$field`";

			if(preg_match("/\./", $field))
			{
				$my_field = "$field";
			}

			if(is_array($value))
			{
				\dash\log::file(json_encode($_where), 'depricated_array', 'database');

				if(isset($value[0]) && isset($value[1]) && is_string($value[0]) && is_string($value[1]))
				{
					$where[] = " $my_field $value[0] $value[1] ";
				}
			}
			elseif($value === null || is_null($value) || $value === '')
			{
				$where[] = " $my_field IS NULL ";
			}
			elseif(is_string($value))
			{
				$where[] = " $my_field = '$value' ";
			}
			elseif(is_numeric($value))
			{
				$where[] = " $my_field = $value ";
			}
		}

		if(!empty($where))
		{
			$where = implode($_options['condition'], $where);
		}
		else
		{
			$where = false;
		}

		return $where;
	}


	/**
	 * Makes a set.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function make_set($_args, $_options = [])
	{
		$default_options =
		[
			'type' => 'update',
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		$set = [];
		foreach ($_args as $key => $value)
		{
			if(!is_string($key))
			{
				continue;
			}

			if($value === null)
			{
				if($_options['type'] === 'insert')
				{
					// continue;
				}
				else
				{
					$set[] = " `$key` = NULL ";
				}
			}
			elseif(is_string($value) && (!isset($value) || $value == '' ))
			{
				if($_options['type'] === 'insert')
				{
					// continue;
				}
				else
				{
					$set[] = " `$key` = NULL ";
				}
			}
			elseif(is_string($value))
			{
				$set[] = " `$key` = '$value' ";
			}
			elseif(is_numeric($value))
			{
				$set[] = " `$key` = $value ";
			}
			elseif(is_bool($value))
			{
				if($value)
				{
					$set[] = " `$key` = 1 ";
				}
				else
				{
					$set[] = " `$key` = NULL ";
				}
			}
			else
			{
				$set[] = " `$key` = '$value' ";
			}
		}

		if(!empty($set))
		{
			if($_options['type'] === 'update')
			{
				$set = implode(',', $set);
			}
			elseif($_options['type'] === 'insert')
			{
				$set = implode(',', $set);
			}
			else
			{
				$set = false;
			}
		}
		else
		{
			$set = false;
		}
		return $set;
	}




	/**
	 * public get from tables
	 *
	 * @param      <type>  $_table  The table
	 * @param      <type>  $_where   The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function public_get($_table, $_where, $_options = [])
	{
		if($_where && $_table)
		{
			$default_options =
			[
				'order'             => null,
				'table_name'        => null,
				'db_name'           => true,
			];

			if(!is_array($_options))
			{
				$_options = [];
			}
			$_options = array_merge($default_options, $_options);

			$only_one_value = false;
			$limit          = null;

			if(isset($_where['limit']))
			{
				if($_where['limit'] === 1)
				{
					$only_one_value = true;
				}

				$limit = " LIMIT $_where[limit] ";
			}

			if(is_array($_where))
			{
				unset($_where['limit']);
			}

			$where = \dash\db\config::make_where($_where, $_options);
			if($where)
			{
				$query = "SELECT * FROM $_table  WHERE $where $_options[order] $limit";
				$result = \dash\pdo::get($query, [], null, $only_one_value, $_options['db_name']);
				return $result;
			}

		}
		return false;
	}


}
?>
