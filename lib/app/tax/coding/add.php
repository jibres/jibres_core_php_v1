<?php
namespace lib\app\tax\coding;


class add
{

	public static function add($_args)
	{

		$args = \lib\app\tax\coding\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$check_duplicate = [];
		$check_duplicate['title'] = $args['title'];
		$check_duplicate['parent1'] = null;
		$check_duplicate['parent2'] = null;
		$check_duplicate['parent3'] = null;

		if(isset($args['parent1']) && $args['parent1'])
		{
			$check_duplicate['parent1'] = $args['parent1'];
		}


		if(isset($args['parent2']) && $args['parent2'])
		{
			$check_duplicate['parent2'] = $args['parent2'];
		}

		if(isset($args['parent3']) && $args['parent3'])
		{
			$check_duplicate['parent3'] = $args['parent3'];
		}

		$check_duplicate_title = \lib\db\tax_coding\get::check_duplicate_title($check_duplicate);
		if(isset($check_duplicate_title['id']))
		{
			\dash\notif::error(T_("Duplicate title"));
			return false;
		}


		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['status']      = 'enable';

		$id = \lib\db\tax_coding\insert::new_record($args);

		\dash\notif::ok(T_("Accounting coding successfully added"));

		return ['id' => $id];
	}

}
?>