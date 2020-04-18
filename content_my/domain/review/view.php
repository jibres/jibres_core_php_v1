<?php
namespace content_my\domain\review;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Review detail"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::userBudget(\dash\user::budget());
	}
}
?>