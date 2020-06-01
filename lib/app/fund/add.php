<?php
namespace lib\app\fund;


class add
{

	public static function add($_args)
	{

		$args = \lib\app\fund\check::variable($_args);
		if(!$args)
		{
			return false;
		}



		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['status']      = 'enable';


		$id = \lib\db\funds\insert::new_record($args);
		if(!$id)
		{
			\dash\log::set('productFundDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		\dash\notif::ok(T_("Fund successfully added"));


		$result       = [];
		$result['id'] = $id;
		return $result;
	}



}
?>