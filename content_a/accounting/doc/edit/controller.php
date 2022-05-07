<?php
namespace content_a\accounting\doc\edit;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');
		$id = \dash\request::get('id');
		$load = \lib\app\tax\doc\get::get($id);
		if(!$load)
		{
			\dash\header::status(404, T_("Tax document not found"));
		}

		\dash\data::dataRow($load);


		$did = \dash\request::get('did');
		if($did)
		{
			$load_detail = \lib\app\tax\docdetail\get::get($did);
			if($did && !$load_detail)
			{
				\dash\header::status(404);
			}

			\dash\data::editModeDetail(true);

			\dash\data::dataRowDetail($load_detail);
		}

		\dash\allow::file();


	}
}
?>
