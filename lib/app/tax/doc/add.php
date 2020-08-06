<?php
namespace lib\app\tax\doc;


class add
{

	public static function add($_args)
	{

		$args = \lib\app\tax\doc\check::variable($_args);


		if(!$args)
		{
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");
		// $args['status']      = 'temp';
		$id = \lib\db\tax_document\insert::new_record($args);

		\dash\notif::ok(T_("Accounting doc successfully added"));

		return ['id' => $id];
	}

}
?>