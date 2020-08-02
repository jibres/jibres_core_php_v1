<?php
namespace content_love\store\domain\detail;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Store domains detail"));

		$id = \dash\request::get('id');
		$detail = \lib\app\store\domain::get_detail($id);

		\dash\data::dataRow($detail);

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());


	}
}
?>
