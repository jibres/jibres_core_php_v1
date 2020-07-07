<?php
namespace content_crm\member\log;


class view
{

	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		\dash\face::title(T_('User log'));

		self::login_list();
	}


	private static function login_list()
	{
		$args = [];
		$args['from'] = \dash\coding::decode(\dash\request::get('id'));
		\content_crm\log\home\view::search_log($args);

	}

}
?>
