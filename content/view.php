<?php
namespace content;

class view
{
	public static function config()
	{
		// define default value for global
		$jibresDesc = '';
		$jibresDesc .= T_('Integrated Ecommerce Platform Software'). ' / ';
		// $jibresDesc .= T_('Start Selling Online.'). ' ';
		if(\dash\language::current() == 'en')
		{
			$jibresDesc .= T_('Quickly Start Free!'). ' ';
		}

		$jibresDesc .= T_('Online Store Website'). T_(' & ');
		$jibresDesc .= T_('Mobile Online Store'). T_(' & ');
		$jibresDesc .= T_('Social Marketing'). T_(' & ');
		$jibresDesc .= T_('POS Software');

		if(\dash\language::current() == 'en')
		{
			$jibresDesc .= ' / ';
			// $jibresDesc .= T_('Accept Credit Cards');
			// $jibresDesc .= T_('Fully Hosted');
			$jibresDesc .= T_('SEO Optimized');
			// $jibresDesc .= T_('SSL Certificate');
			// $jibresDesc .= T_('Fully API');
		}


		\dash\face::site(T_("Jibres"));
		\dash\face::intro($jibresDesc);
		\dash\face::slogan(T_("#1 World Sales Engineering System"));
		\dash\face::slogan(T_("Sell and Enjoy"));






		// if(\dash\url::content() === null)
		// {
		// 	// get total uses
		// 	$total_users                     = 10; // intval(\lib\db\userteams::total_userteam());
		// 	$total_users                     = number_format($total_users);
		// 	$this->data->total_users         = \dash\fit::number($total_users);
		// 	$this->data->footer_stat         = T_("We help :count people to work better!", ['count' => $this->data->total_users]);
		// }

		// if you need to set a class for body element in html add in this value
	}
}
?>