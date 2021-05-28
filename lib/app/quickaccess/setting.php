<?php
namespace lib\app\quickaccess;


class setting
{

	public static function list()
	{
		$list = [];

		$list[] =
		[
			'title'    => T_("Business title"),
			'keywords' =>
			[
				T_("title"),
				T_("site title"),
				T_("business title"),
				T_("business description"),
				T_("description"),
				'title',
				'information',
				T_("information"),
				'description',
				'information',
				T_("information"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general/title',
			'addr'     => [T_("Setting"), T_("General"), T_("Edit title") ],
			'icon'     => 'cogs',
		];

		$list[] =
		[
			'title'    => T_("Business logo"),
			'keywords' =>
			[
				T_("logo"),
				T_("site logo"),
				T_("business logo"),
				T_("store logo"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-logo',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'cogs',
		];


		$list[] =
		[
			'title'    => T_("Business Currency"),
			'keywords' =>
			[
				T_("currency"),
				T_("money"),
				'currency',
				'money',
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-currency',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'money-banknote',
		];


		$mass_list = \lib\units::mass();
		$keyword = array_merge(array_keys($mass_list), array_column($mass_list, 'name'),[T_("weight"),'weight',]);
		$list[] =
		[
			'title'    => T_("Weight unit"),
			'keywords' => $keyword,
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-weight',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'tachometer',
		];

		$length_list = \lib\units::length();
		$keyword = array_merge(array_keys($mass_list), array_column($mass_list, 'name'),[T_("length"),'length',]);
		$list[] =
		[
			'title'    => T_("Length unit"),
			'keywords' => $keyword,
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-length',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'expand',
		];

		$lang_list = \dash\language::all();
		$keyword = array_merge(array_keys($lang_list), array_column($lang_list, 'localname'),[T_("language"),'language',]);
		$list[] =
		[
			'title'    => T_("Business language"),
			'keywords' => $keyword,
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-lang',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'language',
		];



		$list[] =
		[
			'title'    => T_("Business allow sell"),
			'keywords' =>
			[
				T_("sell"),
				T_("allow sell"),
				T_("lock sell"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-nosale',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'lock',
		];


		$list[] =
		[
			'title'    => T_("Allow enter customer to business"),
			'keywords' =>
			[
				T_("enter"),
				T_("login"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-allow-enter',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'enter',
		];


		$list[] =
		[
			'title'    => T_("Remove business"),
			'keywords' =>
			[
				T_("remove"),
			],
			'url'      => \dash\url::kingdom(). '/a/setting/general#setting-busienss-remove',
			'addr'     => [T_("Setting"), T_("General") ],
			'icon'     => 'trash',
		];


		$list[] =
		[
			'title'    => T_("Sitemap"),
			'keywords' => [T_("site"), T_("site map"), T_("sitemap"), 'sitemap', T_("map"), 'map'],
			'url'      => \dash\url::kingdom(). '/cms/sitemap',
			'addr'     => [T_("Content Management System"), T_("SEO") ],
			'icon'     => 'sitemap',
		];

		$list[] =
		[
			'title'    => T_("Config"),
			'keywords' => [T_("setting"), T_("config"), T_("ratio"), 'image', T_("image ratio")],
			'url'      => \dash\url::kingdom(). '/cms/config',
		];

		$list[] =
		[
			'title'    => T_("ArvanCloud"),
			'keywords' => [T_("Arvan"), T_("ArvanCloud"), T_("Storage"), 'Arvan', "ArvanCloud", "Arvan Cloud", "File"],
			'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/arvanclouds3',
			'addr'     => [T_("Setting"), T_("Third Party Services"), T_("S3") ],
			'img'      => \dash\url::cdn(). '/img/thirdparty/arvancloud.svg',
		];


		return $list;
	}
}
?>