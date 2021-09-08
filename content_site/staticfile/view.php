<?php
namespace content_site\staticfile;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Static file veirfy'));

		$staticfile = \lib\app\staticfile\get::get_list();
		\dash\data::fileList($staticfile);

		// back

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::include_adminPanelBuilder(true);
	}
}
?>