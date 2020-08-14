<?php
namespace lib\app\tax\docdetail;


class edit
{

	public static function edit($_args, $_id)
	{
		$load = \lib\app\tax\docdetail\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}


		$args = \lib\app\tax\docdetail\check::variable($_args, $load, $load['id']);

		if(!$args)
		{
			return false;
		}

		// $data = \dash\cleanse::patch_mode($_args, $args);
		$tax_document_id = \dash\get::index($args, 'tax_document_id');
		unset($args['tax_document_id']);
		unset($args['year_id']);


		if(empty($args))
		{
			\dash\notif::info(T_("No change in your data"));
		}
		else
		{
			$args['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\tax_docdetail\update::update($args, $load['id']);

			if(isset($tax_document_id))
			{
				\lib\app\tax\doc\balance::set($tax_document_id);
			}

			\dash\notif::ok(T_("Accounting docdetail successfully updated"));
		}

		return true;
	}

}
?>