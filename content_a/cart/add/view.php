<?php
namespace content_a\cart\add;


class view
{
	public static function config()
	{

		// show dropdown of product list
		\lib\app\product\site_list::dropdown();

		\dash\face::title(T_('Add cart'));

		$user = \dash\request::get('user');
		$guestid = \dash\request::get('guestid');

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$dataTable = \lib\app\cart\search::detail($user, $guestid);

		\dash\data::dataTable($dataTable);

		if(\dash\request::get('user'))
		{
			$user_detail = \dash\app\user::get(\dash\request::get('user'));
			\dash\data::userDetail($user_detail);
		}
	}
}
?>
