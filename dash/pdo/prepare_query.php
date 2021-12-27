<?php
namespace dash\pdo;


class prepare_query
{

	public static function ready_for_multi_insert($_args, $_raw = false)
	{
		if(!is_array($_args))
		{
			return false;
		}

		// marge all input array to creat list of field to be insert
		$fields = [];
		foreach ($_args as $key => $value)
		{
			$fields = array_merge($fields, $value);
		}

		$fields = array_keys($fields);

		// creat multi insert query : INSERT INTO TABLE (FIELDS) VLUES (values), (values), ...
		$values         = [];
		$param          = [];
		$value_position = [];

		foreach ($_args	 as $key => $value)
		{
			$temp = [];

			foreach ($fields as $field_name)
			{
				$myKey = ':k_'. $key. '_';
				$myKey .= $field_name;
				$temp[] = $myKey;


				$values[$myKey] = null;
				if(array_key_exists($field_name, $value))
				{
					$values[$myKey] = $value[$field_name];
				}

				$param[$myKey] = $values[$myKey];

			}

			$value_position[] = '('. implode(',', $temp). ')';

		}

		$fields = '`'.  implode("`,`", $fields). '`';

		$values = implode(",", $value_position);

		$temp_query = "($fields) VALUES $values ";

		return
		[
			'fields' => $fields,
			'param'  => $param,
			'query'  => $temp_query,
		];
	}



	/**
	 * Ready args for search
	 *
	 * @param      <type>  $_and         And
	 * @param      <type>  $_or          { parameter_description }
	 * @param      <type>  $_order_sort  The order sort
	 * @param      array   $_meta        The meta
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	public static function ready_to_sql($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$where = null;
		$q     = [];


		if($_and)
		{
			$_and = implode(' AND ', $_and);
			$q[] = "$_and";

		}

		if($_or)
		{
			$_or = implode(' OR ', $_or);
			$q[] = "($_or)";
		}

		if($q)
		{
			$where = 'WHERE '. implode(" AND ", $q);
		}

		$order = null;
		if($_order_sort && is_string($_order_sort))
		{
			$order = $_order_sort;
		}

		$pagination = null;
		if(array_key_exists('pagination', $_meta))
		{
			$pagination = $_meta['pagination'];
		}

		$limit = null;
		if(array_key_exists('limit', $_meta))
		{
			$limit = $_meta['limit'];
		}

		$start_limit = null;
		if(array_key_exists('start_limit', $_meta))
		{
			$start_limit = $_meta['start_limit'];
		}

		if(isset($_meta['join']) && is_array($_meta['join']) && $_meta['join'])
		{
			$join = implode(' ', $_meta['join']);
		}
		else
		{
			$join = null;
		}

		$fields = '*';
		if(isset($_meta['fields']))
		{
			$fields = $_meta['fields'];
		}

		$result =
		[
			'where'       => $where,
			'order'       => $order,
			'pagination'  => $pagination,
			'limit'       => $limit,
			'start_limit' => $start_limit,
			'join'        => $join,
			'fields'      => $fields,
			'limit_string' => "LIMIT $limit",
		];

		return $result;
	}


	/**
	 * Generate where
	 *
	 * @param      string  $_table  The table
	 * @param      array   $_where  The where
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	public static function generate_where(string $_table, array $_where) : array
	{

		$where = [];
		$param = [];
		$i     = 0;

		foreach ($_where as $field => $value)
		{
			$i++;

			$my_field = "`$_table`.`$field`";

			if(preg_match("/\./", $field))
			{
				$my_field = "$field";
			}

			$my_field_key = ':'. $i. '_'. mb_strlen($field). $field;

			if($value === null || is_null($value) || $value === '')
			{
				$where[] = " $my_field IS NULL ";
			}
			elseif(is_string($value) || is_numeric($value))
			{
				$where[] = " $my_field = $my_field_key ";

				$param[$my_field_key] = $value;
			}
		}

		$result          = [];
		$result['where'] = implode(' AND ', $where);
		$result['param'] = $param;

		return $result;


	}

}
?>