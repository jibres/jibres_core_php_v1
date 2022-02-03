<?php
namespace content_a\setting3\home\section;

class other
{

	public static function list()
	{
		$list = [];

		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("Business description"),
			'desc'        => T_("This title use in your business"),
			'input'       =>
			[
				\content_a\setting3\home\view::switcher('set_desc'),

				[
					'type'        => 'textarea',
					'name'        => 'desc',
					'value'       => \lib\store::desc(),
					// 'placeholder' => 'Title',
				],
			],
		];




		return $list;
	}
}
?>