<?php
namespace content_love\domain\autorenew;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$args =
		[
			'predict'             => true,
			'autorenew_mode'      => 1,
			'autorenew_adminlist' => 'yes',
		];

		$list = \lib\app\nic_domain\search::get_list(null, $args);

		\dash\data::myList($list);



	}
}
?>
