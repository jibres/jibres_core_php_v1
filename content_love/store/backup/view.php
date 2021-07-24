<?php
namespace content_love\store\backup;


class view extends \content_love\store\setting\view
{
	public static function config()
	{
		\dash\face::title(T_("Backup"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/setting?id='. \dash\request::get('id'));

		\dash\face::btnInsert('formrun');
		\dash\face::btnInsertText(T_("Backup Now"));

		$result = \lib\app\store\backup::get(\dash\request::get('id'));
		\dash\data::currentBackup($result);

		if(\dash\request::get('download') == '1')
		{
			if(isset($result['filename']))
			{
				\dash\file::download($result['filename']);
			}
		}
	}
}
?>
