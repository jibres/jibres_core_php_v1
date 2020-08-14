<?php
namespace lib\app\tax\docdetail;


class add
{

	public static function add($_args)
	{

		$args = \lib\app\tax\docdetail\check::variable($_args);


		if(!$args)
		{
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");
		// $args['status']      = 'temp';
		$id = \lib\db\tax_docdetail\insert::new_record($args);


		if(isset($args['tax_document_id']))
		{
			\lib\app\tax\doc\balance::set($args['tax_document_id']);
		}

		\dash\notif::ok(T_("Accounting docdetail successfully added"));

		return ['id' => $id];
	}

}
?>