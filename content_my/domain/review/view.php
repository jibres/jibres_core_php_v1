<?php
namespace content_my\domain\review;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Review and Confirm Domain Detail"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::userBudget(\dash\user::budget());


		$gift = \dash\request::get('gift');
		if($gift)
		{
			$gift_args =
			[
				'code'    => $gift,
				'price'   => \dash\data::myPrice(),
				'user_id' => \dash\user::id(),
				'usein'   => 'domain',
			];

			$detail = \lib\app\gift\check::check($gift_args);
			\dash\data::giftDetail($detail);
		}

		switch (\dash\request::get('type'))
		{
			case 'register':
				\dash\data::myActionTitle(T_("Register domain"));
				\dash\data::backUrl(\dash\url::this(). '/buy/'. \dash\data::dataRow_name());
				\dash\data::buttonTitle(T_("Register domain"));
				break;

			case 'renew':
				\dash\data::myActionTitle(T_("Renew domain"));
				\dash\data::backUrl(\dash\url::this(). '/renew?domain='. \dash\data::dataRow_name());
				\dash\data::buttonTitle(T_("Renew domain"));
				break;

			default:
				# code...
				break;
		}
	}
}
?>