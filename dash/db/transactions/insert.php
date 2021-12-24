<?php
namespace dash\db\transactions;


class insert
{

	public static function new_record($_args)
	{
		if(a($_args, 'status') === null)
		{
			$_args['status'] = 'enable';
		}

		return \dash\pdo\query_template::insert('transactions', $_args);
	}
}
?>