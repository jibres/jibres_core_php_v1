<?php
namespace content\portfolio;


class view
{
	public static function config()
	{
		$myTitle = T_('Jibres Portfolio');

		if(\dash\request::get('tag'))
		{
			$myTitle .= ' #'. \dash\request::get('tag');
		}

		\dash\face::title($myTitle);

		\dash\face::desc(T_("All websites are fully customizable with drag and drop. Personalize your website, pick a domain and get online today"));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-portfolio-1.jpg');


		$list = \dash\app\portfolio::public_list(\dash\request::get('tag'));
		\dash\data::dataTable($list);

		var_dump($list);exit;

		if(!$list && \dash\request::get())
		{
			\dash\redirect::to(\dash\url::this());
		}



	}
}
?>