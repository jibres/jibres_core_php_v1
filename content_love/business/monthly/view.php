<?php
namespace content_love\business\monthly;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Transaction Report"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$result = \lib\app\store\stats_monthly::get_all();

		\dash\data::monthlyList($result);

		\dash\face::btnInsert('calcagain');
		\dash\face::btnInsertText(T_("Calculate again"));



	}
}
?>