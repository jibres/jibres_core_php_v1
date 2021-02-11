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


		$my_list = [];
		foreach (['1week', '1month', '6month'] as $date)
		{
			$args =
			[
				'predict'        => true,
				'autorenew_mode' => $date,
				'autorenew_notif' => 'yes',
			];

			$list = \lib\app\nic_domain\search::get_list(null, $args);

			if($list && is_array($list))
			{
				$my_list = array_merge($my_list, $list);
			}
		}

		\dash\data::myList($my_list);



	}
}
?>
