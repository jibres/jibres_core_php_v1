<?php
namespace content_love\business\domain\dns;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain DNS Detail"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::that());

		\content_love\business\domain\load::dashboardDetail();



		$dnsList = \lib\app\business_domain\dns::list(\dash\data::dataRow_id());
		\dash\data::dnsList($dnsList);

		$server_key = array_column($dnsList, 'serverkey');
		$server_key = array_filter($server_key);
		$server_key = array_unique($server_key);
		if(count($server_key) === 1 && isset($server_key[0]))
		{
			\dash\data::currentServerKey($server_key[0]);
		}

		$server_list = \dash\setting\servername::get_list();
		\dash\data::serverList($server_list);

	}
}
?>
