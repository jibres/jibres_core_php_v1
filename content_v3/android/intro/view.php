<?php
namespace content_v3\android\intro;


class view
{
	public static function config()
	{
		$page = \lib\app\application\intro::get();

		unset($page['theme']);
		unset($page['usersaved']);

		$page = array_values($page);
		$page = array_filter($page);


		$from = '#c80a5a';
		$to   = '#c80a5a';

		$result =
		[
			'page' => $page,

			'translation' =>
			[
				'next'  => T_('Next'),
				'prev'  => T_('Prev'),
				'skip'  => T_('Skip'),
				'start' => T_('Get Start'),
			],
			'theme' => 'store1',
			'bg' =>
			[
				'from' => $from,
				'to'   => $to,
			],
			'color' =>
			[
				'primary'   => '#ffffff',
				'secondary' => '#eeeeee',
			],
		];

		\content_v3\tools::say($result);

	}
}
?>