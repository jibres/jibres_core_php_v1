<?php
namespace lib\app\tax\doc;


class remove
{

	public static function remove($_id)
	{
		$load = \lib\app\tax\doc\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}



		\lib\db\tax_docdetail\delete::by_doc_id($load['id']);
		\lib\db\tax_document\delete::by_id($load['id']);

		\dash\notif::ok(T_("Data removed"));

		return true;
	}

}
?>