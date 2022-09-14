<?php
namespace content_a\sms\charge;



class view
{
	public static function config()
	{
		\dash\face::title(T_("Charge SMS"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here(). '/plan');


		\dash\data::global_scriptPage("my_domain_review.js");


		$smsDeail = \lib\app\business_sms\charge::getDetail();

		\dash\data::smsChargeDetail($smsDeail);


	}
}

