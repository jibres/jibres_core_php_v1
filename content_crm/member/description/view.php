<?php
namespace content_crm\member\description;


class view
{
	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		\dash\face::title(T_('User description'));

		$args              = [];
		$args['user_id']   = \dash\coding::decode(\dash\request::get('id'));
		$dataTable         = \dash\db\userdetail::search(null, $args);

		\dash\data::dataTable($dataTable);
	}
}
?>