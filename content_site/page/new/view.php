<?php
namespace content_site\page\new;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new Page'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here(). '/pages');

		if(\dash\detect\device::detectPWA())
		{
			\dash\face::btnInsert('formAddPost');
		}

		\dash\data::mySiteBuilderPageTitle(\dash\session::get('mySiteBuilderPageTitle'));

		\dash\data::include_adminPanelBuilder(true);

		$template_list = \content_site\template\preview::list();
		\dash\data::templateList($template_list);

	}
}
?>