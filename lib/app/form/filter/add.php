<?php
namespace lib\app\form\filter;


class add
{
	public static function duplicate($_args, $_form_id, $_filter_id)
	{

		$load_filter = \lib\app\form\filter\get::get($_filter_id);
		if(!$load_filter)
		{
			return false;
		}

		$result = self::add($_args, $_form_id);
		if(!isset($result['id']))
		{
			return false;
		}

		\lib\db\form_filter\insert::duplicate($_form_id, $_filter_id, $result['id']);
		return ['id' => $result['id']];
	}


	public static function add($_args, $_form_id)
	{

		$load = \lib\app\form\form\get::get($_form_id);
		if(!$load)
		{
			return false;
		}


		$args = \lib\app\form\filter\check::variable($_args);

		if(!$args)
		{
			return false;
		}


		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['form_id']      = $_form_id;

		$id = \lib\db\form_filter\insert::new_record($args);

		\dash\notif::ok(T_("Condition successfully added"));

		return ['id' => $id];
	}


	public static function add_where($_args, $_form_id, $_filter_id)
	{
		$load = \lib\app\form\form\get::get($_form_id);
		if(!$load)
		{
			return false;
		}

		$fields = \lib\app\form\form\ready::fields($load);

		$args = \lib\app\form\filter\check::variable_where($_args, $fields);


		if(!$args)
		{
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['form_id']     = $_form_id;
		$args['filter_id']   = $_filter_id;

		$id = \lib\db\form_filter\insert::new_record_where($args);

		\dash\notif::ok(T_("Condition successfully added"));

		return ['id' => $id];
	}
}
?>