<?php
namespace lib\db\form_tag;


class insert
{

	public static function group_tag($_param, $_and = null, $_or = null, $_order_sort = null, $_meta = [], $_tag_id = null)
	{
		$q = \dash\pdo\prepare_query::binded_ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$_param[':the_tag_id'] = $_tag_id;
		$_param[':the_form_id'] = $_param[':form_id'];
		$_param[':mydate']     = date("Y-m-d H:i:d");

		$query =
		"
			INSERT INTO form_tagusage
			(`form_tag_id`, `form_id`, `answer_id`, `datecreated`)
			SELECT
				:the_tag_id,
				:the_form_id,
				form_answer.id,
				:mydate
			FROM
				form_answer
				$q[join]
				$q[where]
		";


		$result = \dash\pdo::get($query, $_param);


		return $result;

	}

	public static function apply_to_filter($_tag_id, $_form_id, $_table_name, $_where, $_type)
	{
		if(!$_where)
		{
			return false;
		}

		$where = implode(' AND ', $_where);

		if($_type === 'include' || $_type === 'notinclude')
		{
			$type = $_type === 'include' ? '  ' : ' NOT  ';

			$query =
			"
				INSERT IGNORE INTO
					`form_tagusage`
					(`form_tag_id`,`form_id`, `answer_id`)
				SELECT
					$_tag_id,
					$_form_id,
					`$_table_name`.`f_answer_id`
				FROM
					`$_table_name`
				WHERE $type	( $where )
			";

		}
		else
		{
			$query =
			"
				INSERT IGNORE INTO
					`form_tagusage`
					(`form_tag_id`,`form_id`, `answer_id`)
				SELECT
					$_tag_id,
					$_form_id,
					`$_table_name`.`f_answer_id`
				FROM
					`$_table_name`
			";
		}

		$result = \dash\pdo::query($query, []);
		return $result;
	}



	public static function multi_insert()
	{
		return \dash\pdo\query_template::multi_insert('form_tag', ...func_get_args());
	}



	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('form_tag', $_args);
	}

	public static function get_answer_id_before_apply_to_filter($_table_name, $_where, $_type, $_rand_limit = null)
	{
		if(!$_where)
		{
			return false;
		}

		$where = implode(' AND ', $_where);
		$limit = null;
		if($_rand_limit)
		{
			$limit = " ORDER BY rand() LIMIT $_rand_limit ";
		}


		if($_type === 'include' || $_type === 'notinclude')
		{
			$type = $_type === 'include' ? '  ' : ' NOT  ';

			$query =
				"
				SELECT
					`$_table_name`.`f_answer_id` AS `id`
				FROM
					`$_table_name`
				WHERE $type	( $where )
				$limit
			";

		}
		else
		{
			$query =
				"
				SELECT
				
					`$_table_name`.`f_answer_id` AS `id`
				FROM
					`$_table_name`
				$limit
			";
		}

		$result = \dash\pdo::get($query, [], 'id');
		return $result;
	}


}
?>
