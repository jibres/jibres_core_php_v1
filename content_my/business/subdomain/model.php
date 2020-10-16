<?php
namespace content_my\business\subdomain;


class model
{
	public static function post()
	{

		$subdomain       = \dash\validate::string_50(\dash\request::post('sd'));
		$subdomain_raw = $subdomain;

		\dash\temp::set('clesnse_not_end_with_error', true);

		$subdomain = \dash\validate::subdomain($subdomain, true, ['element' => 'sd', 'field_title' =>  'subdomain']);

		if(!$subdomain)
		{
			\dash\log::set('business_creatingNew', ['my_step' => 'subdomain', 'my_subdomain' => $subdomain_raw, 'my_invalid_subdomain' => true, 'my_notif' => \dash\notif::get()]);
			return false;
		}

		$check_exist = \lib\db\store\get::subdomain_exist($subdomain);

		if($check_exist)
		{
			\dash\log::set('business_creatingNew', ['my_step' => 'subdomain', 'my_subdomain' => $subdomain, 'my_duplicate' => true]);
			\dash\notif::error(T_("This subdomain is already occupied"), 'sd');
			return false;
		}

		\dash\log::set('business_creatingNew', ['my_step' => 'subdomain', 'my_subdomain' => $subdomain, 'my_invalid_subdomain' => false, 'my_start_creating' => true]);

		\dash\redirect::to(\dash\url::this().'/creating?'. \dash\request::fix_get(['subdomain' => $subdomain, 'st3' => time()]));
	}
}
?>
