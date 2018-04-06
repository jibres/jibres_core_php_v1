<?php
namespace content;

class view
{
	public static function config()
	{
		// define default value for global


		\dash\data::site_title(T_("Jibres"));
		\dash\data::site_desc(T_("Jibres is not just an online accounting software;"). ' '.  T_("We try to create the best financial platform that has everything you need to sale and manage your financial life."));
		\dash\data::site_slogan(T_("Integrated Sales and Online Accounting"));

		\dash\data::page_desc(\dash\data::site_desc(). ' | '. \dash\data::site_slogan());

		\dash\data::bodyclass('unselectable');

		// for pushstate of main page
		\dash\data::template_xhr('content/main/layout-xhr.html');

		\dash\data::display_admin('content_a/main/layout.html');
		\dash\data::template_social('content/template/social.html');
		\dash\data::template_share('content/template/share.html');
		\dash\data::template_price('content/template/priceTable.html');
		\dash\data::template_priceSchool('content/template/priceSchoolTable.html');

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