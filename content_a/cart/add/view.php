<?php
namespace content_a\cart\add;


class view
{
	public static function config()
	{

		// show dropdown of product list
		\lib\app\product\site_list::dropdown();

		\dash\face::title(T_('Add cart'));

		$identify = \dash\request::get('identify');

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$dataTable = \lib\app\cart\search::detail($identify);

		\dash\data::dataTable($dataTable);


		// $user_detail = \dash\app\user::get($user);
		// \dash\data::userDetail($user_detail);
	}
}
?>
