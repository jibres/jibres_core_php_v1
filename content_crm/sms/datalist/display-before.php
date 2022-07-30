<?php

if(\dash\request::get('status') === 'moneylow')
{
	$notSentSMSCount = \lib\app\sms\get::notSentSMSCount();
	if($notSentSMSCount)
	{
		$resendAll = true;
		require_once(root.'content_crm/sms/display-resend.php');
	}
}
