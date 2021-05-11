<?php
namespace content_a\tag\sort;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Sort Product tags'));

		\dash\data::back_text(T_('Tags'));
		\dash\data::back_link(\dash\url::this());


		// work with category list
		\dash\data::dataTable(\lib\app\tag\search::list(null, ['pagination' => false, 'showonwebsite' => 1]));
	}
}
?>