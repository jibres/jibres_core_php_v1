<?php
namespace lib\app\tax\doc;


class add
{

	public static function duplicate($_id, $_args)
	{
		$load = \lib\app\tax\doc\get::get($_id);
		if(!isset($load['id']))
		{
			return false;
		}

		$add =
		[
			'number'  => \dash\get::index($_args, 'number'),
			'desc'    => \dash\get::index($load, 'desc'),
			'date'    => \dash\get::index($_args, 'date'),
			'year_id' => \dash\get::index($load, 'year_id'),
		];

		$new_doc = self::add($add);
		if(isset($new_doc['id']))
		{
			\lib\db\tax_docdetail\insert::duplicate($_id, $new_doc['id']);
			\lib\app\tax\doc\balance::set($new_doc['id']);
		}



		return $new_doc;

	}

	public static function add($_args)
	{

		$args = \lib\app\tax\doc\check::variable($_args);


		if(!$args)
		{
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");

		if(!$args['type'])
		{
			$args['type'] = 'normal';
		}

		if($args['type'] !== 'normal')
		{
			if(isset($args['year_id']))
			{
				$check_duplicate = \lib\db\tax_document\get::check_duplicate_type($args['year_id'], $args['type']);
				if(isset($check_duplicate['id']))
				{
					\dash\notif::error(T_("This document already add to this year"));
					return false;
				}
			}
		}

		$id = \lib\db\tax_document\insert::new_record($args);

		\dash\notif::ok(T_("Accounting doc successfully added"));

		return ['id' => $id];
	}

}
?>