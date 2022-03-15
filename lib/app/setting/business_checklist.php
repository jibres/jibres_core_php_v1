<?php
namespace lib\app\setting;


class business_checklist
{
	public static function summary()
	{

		// industry
		// app
		// product
		// doamin
		// sale
		// news
		$list = [];

		$list[] =
		[
			'title' => T_("Business title"),
			'link'  => \dash\url::kingdom(). '/a/setting/general/title',
			'ok'    => boolval(\lib\store::title()),
		];

		$list[] =
		[
			'title' => T_("Business logo"),
			'link'  => \dash\url::kingdom(). '/a/setting/general',
			'ok'    => boolval(\lib\store::logo(true)),
		];

		$list[] =
		[
			'title' => T_("Business description"),
			'link'  => \dash\url::kingdom(). '/a/setting/general/title',
			'ok'    => boolval(\lib\store::desc()),
		];

		$list[] =
		[
			'title' => T_("Add product"),
			'link'  => \dash\url::kingdom(). '/a/products/add',
			'ok'    => boolval(\lib\db\products\get::have_any_product()),
		];


		$list[] =
		[
			'title' => T_("Connect to Domain"),
			'link'  => \dash\url::kingdom(). '/a/setting/domain',
			'ok'    => boolval(\lib\store::master_domain()),
		];

		$list[] =
		[
			'title' => T_("First sale"),
			'link'  => \dash\url::kingdom(). '/a/sale',
			'ok'    => boolval(\lib\db\factors\get::have_any_factor()),
		];

		$list[] =
		[
			'title' => T_("First post"),
			'link'  => \dash\url::kingdom(). '/cms/posts/add',
			'ok'    => boolval(\dash\db\posts\get::have_any_post()),
		];


		$homepage      = \content_site\homepage::code();

		$homepage_link = \dash\url::kingdom(). '/site';

		if($homepage)
		{
			$homepage_link .= '/page?id='. $homepage;
		}
		else
		{

			$homepage_link .= '/page/new';
		}

		$list[] =
		[
			'title' => T_("Setup website homepage"),
			'link'  => $homepage_link,
			'ok'    => boolval($homepage),
		];



		$percent = (100* count(array_filter(array_column($list, 'ok')))) / count($list);

		if($percent > 100)
		{
			$percent = 100;
		}

		if($percent < 0)
		{
			$percent = 0;
		}

		$businessCheckLisst =
		[
			'visible' => !($percent >= 100),
			'percent' => $percent,
			'list'    => $list,
		];

		return $businessCheckLisst;

	}
}
?>
