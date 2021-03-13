<?php
namespace content_my\business\subdomain;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Business address"));

		\dash\data::userToggleSidebar(false);

		// if(\dash\detect\device::detectPWA())
		{
			// back
			\dash\data::back_text(T_('Cancel'));
			\dash\data::back_link(\dash\url::this());
		}

		$session = \content_my\business\creating::get_session();
		if(isset($session['domain']) && $session['domain'])
		{
			$temp = preg_replace("/\.(.*)$/", '', $session['domain']);
			$temp = preg_replace("/[^a-zA-Z0-9]/", '', $temp);

			if(mb_strlen($temp) < 5)
			{
				$temp .= 'store';
			}

			\dash\data::tempSubdomain($temp);
		}
	}
}
?>
