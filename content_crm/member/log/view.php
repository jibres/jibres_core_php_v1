<?php
namespace content_crm\member\log;


class view
{

	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		\dash\data::page_title(T_('User log'));

		\dash\data::action_link(\dash\url::this());
		\dash\data::action_text(T_('Back to dashbaord'));

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
