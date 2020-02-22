<?php
if(!\dash\data::myDomain())
{
	require_once (root. 'content_my/domain/buy/step1_domian.php');
}
else
{
	if(!\dash\request::get('period'))
	{
		require_once (root. 'content_my/domain/buy/step2_period.php');
	}
	elseif(!\dash\request::get('irnicid') && \dash\request::get('period'))
	{
		require_once (root. 'content_my/domain/buy/step3_nic_contact.php');
	}
	elseif(\dash\request::get('irnicid') && \dash\request::get('period'))
	{
		require_once (root. 'content_my/domain/buy/step4_dns.php');
	}
	else
	{
		require_once (root. 'content_my/domain/buy/step1_domian.php');
	}
}


?>