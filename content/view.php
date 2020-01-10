<?php
namespace content;

class view
{
	public static function config()
	{
		// define default value for global
		$jibresDesc = '';
		$jibresDesc .= T_('Integrated Ecommerce Platform Software'). ' / ';
		$jibresDesc .= T_('Start Selling Online.'). ' ';
		$jibresDesc .= T_('Quickly Start Free!'). ' ';

		$jibresDesc .= T_('Online Store Website'). T_(' & ');
		$jibresDesc .= T_('Mobile Online Store'). T_(' & ');
		$jibresDesc .= T_('Social Marketing'). T_(' & ');
		$jibresDesc .= T_('POS Software'). ' | ';

		$jibresDesc .= T_('Accept Credit Cards'). '. ';
		$jibresDesc .= T_('Fully Hosted'). '. ';
		$jibresDesc .= T_('SEO Optimized'). '. ';
		$jibresDesc .= T_('SSL Certificate'). '. ';
		$jibresDesc .= T_('Fully API');


		\dash\data::site_title(T_("Jibres"));
		\dash\data::site_desc($jibresDesc);
		\dash\data::site_slogan(T_("Integrated Sales and Online Accounting"));



		// add page cover to all pages
		\dash\data::page_cover(\dash\url::static(). '/img/cover/Jibres-cover-fa-1.jpg');

		\dash\data::bodyclass('unselectable');


		// if(\dash\url::content() === null)
		// {
		// 	// get total uses
		// 	$total_users                     = 10; // intval(\lib\db\userteams::total_userteam());
		// 	$total_users                     = number_format($total_users);
		// 	$this->data->total_users         = \dash\utility\human::number($total_users);
		// 	$this->data->footer_stat         = T_("We help :count people to work beter!", ['count' => $this->data->total_users]);
		// }

		// if you need to set a class for body element in html add in this value
		// $this->data->bodyclass           = null;
	}
}
?>