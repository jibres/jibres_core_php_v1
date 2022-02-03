<?php
namespace content_a\setting3\home\section;

class security
{

	public static function list()
	{
		$list = [];


		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("No sale"),
			'desc'        => T_("Description"),
			'input'       =>
			[
				\content_a\setting3\home\view::switcher('set_nosale'),
				[
					'type'  => 'checkbox',
					'name'  => 'nosale',
					'value' => \lib\store::detail('nosale'),

				],
			],
		];


		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("enterdisallow"),
			'desc'        => T_("Description"),
			'input'       =>
			[
				\content_a\setting3\home\view::switcher('set_enterdisallow'),
				[
					'type'  => 'checkbox',
					'name'  => 'enterdisallow',
					'value' => \lib\store::detail('enterdisallow'),

				],
			],
		];


		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("entersignupdisallow"),
			'desc'        => T_("Description"),
			'input'       =>
			[
				\content_a\setting3\home\view::switcher('set_entersignupdisallow'),
				[
					'type'  => 'checkbox',
					'name'  => 'entersignupdisallow',
					'value' => \lib\store::detail('entersignupdisallow'),

				],
			],
		];


		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("disallowsearchengine"),
			'desc'        => T_("Description"),
			'input'       =>
			[
				\content_a\setting3\home\view::switcher('set_disallowsearchengine'),
				[
					'type'  => 'checkbox',
					'name'  => 'disallowsearchengine',
					'value' => \lib\store::detail('disallowsearchengine'),

				],
			],
		];


		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("forceloginorder"),
			'desc'        => T_("Description"),
			'input'       =>
			[
				\content_a\setting3\home\view::switcher('set_forceloginorder'),
				[
					'type'  => 'checkbox',
					'name'  => 'forceloginorder',
					'value' => \lib\store::detail('forceloginorder'),

				],
			],
		];


		$remove =
		[
			'option_mode'  => 'btn',
			'special_html' => 'remove',
			'title'        => T_("Busienss remove"),
			'btn_link'     => \dash\url::that(). '/remove',
			'btn_title'    => T_("Remove"),
			'btn_class'    => 'btn-danger',

		];


        $list['remove'] = $remove;

		return $list;
	}
}
?>