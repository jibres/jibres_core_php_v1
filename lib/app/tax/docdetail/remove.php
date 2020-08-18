<?php
namespace lib\app\tax\docdetail;


class remove
{

	public static function remove($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\tax\docdetail\get::get($id);
		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$tax_document_id = \dash\get::index($load, 'tax_document_id');

		$check_doc_status = \lib\app\tax\doc\check::check_doc_status($tax_document_id);
		if(!$check_doc_status)
		{
			return false;
		}

		\lib\db\tax_docdetail\delete::by_id($id);

		if(isset($tax_document_id))
		{
			\lib\app\tax\doc\balance::set($tax_document_id);
		}

		\dash\notif::ok(T_("Data removed"));

		return true;
	}

}
?>