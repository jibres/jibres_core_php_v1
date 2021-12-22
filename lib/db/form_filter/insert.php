<?php
namespace lib\db\form_filter;


class insert
{

	public static function duplicate($_form_id, $_old_filter_id, $_new_filter_id)
	{
		$date = date("Y-m-d H:i:s");

		$query =
		"
			INSERT INTO form_filter_where
			(

				`form_id`,
				`filter_id`,
				`operator`,
				`field`,
				`condition`,
				`value`,
				`datecreated`
			)
			SELECT
				$_form_id,
				$_new_filter_id,
				form_filter_where.operator,
				form_filter_where.field,
				form_filter_where.condition,
				form_filter_where.value,
				'$date'
			FROM
				form_filter_where
			WHERE form_filter_where.form_id = $_form_id AND form_filter_where.filter_id = $_old_filter_id
		";
		$result = \dash\pdo::query($query, []);
		return $result;
	}


	/**
	 * Insert new record to product category table
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('form_filter', $_args);
	}


	public static function new_record_where($_args)
	{
		return \dash\pdo\query_template::insert('form_filter_where', $_args);
	}

}
?>
