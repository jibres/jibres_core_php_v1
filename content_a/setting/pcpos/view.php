<?php
namespace content_a\setting\pcpos;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Pos'));

		\dash\data::dataTable(\lib\app\pos\datalist::list());

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/pos');
	}
}
?>