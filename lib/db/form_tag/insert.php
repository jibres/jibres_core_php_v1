<?php
namespace lib\db\form_tag;


class insert
{

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
		return \dash\db\config::public_multi_insert('form_tag', ...func_get_args());
	}



	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('form_tag', $_args);
	}


}
?>
