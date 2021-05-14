<?php
namespace content_a\products\status;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		\dash\face::title(T_("Status"));

		// \dash\face::btnSave('form1');
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));

		if(\dash\data::productDataRow_status() === 'deleted')
		{
			\dash\data::productIsDeleted(true);
			\dash\face::title($title. ' ('. T_("Deleted"). ')');

		}

	}
}
?>
