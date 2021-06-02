<?php
namespace content_enter\signup;

class view
{

	public static function config()
	{

		\dash\face::title(T_('Signup in :name' , ['name' => \dash\face::hereTitle()]));
		\dash\face::specialTitle(true);
		\dash\face::desc(\dash\face::title());

		// set el value to use in display
		\dash\data::el_username(false);

		// back
		// \dash\data::back_link(\dash\url::here());
		// \dash\data::back_text(T_('Enter'));
		// action
		\dash\data::action_text(T_('Enter'));
		\dash\data::action_link(\dash\url::here());

		if(\dash\engine\store::inStore())
		{
			$load = \lib\app\setting\policy_page::admin_load();
			if(isset($load['privacy_policy_page']['detail']['link']) && isset($load['termsofservice_page']['detail']['link']))
			{
				$termLink = '<a href="'. $load['termsofservice_page']['detail']['link'] . '" target="_blank">'. T_('Terms of Service') .'</a>';
				$privacyLink = '<a href="'. $load['privacy_policy_page']['detail']['link']. '" target="_blank">'. T_('Privacy Policy') .'</a>';

				\dash\data::termOfService(T_("By clicking Sign Up, you are indicating that you have read the :privacy and agree to the :terms.", ['privacy' => $privacyLink, 'terms' => $termLink]));
			}

		}
		else
		{

			$termLink = '<a href="'. \dash\url::kingdom(). '/terms" target="_blank">'. T_('Terms of Service') .'</a>';
			$privacyLink = '<a href="'. \dash\url::kingdom(). '/privacy" target="_blank">'. T_('Privacy Policy') .'</a>';

			\dash\data::termOfService(T_("By clicking Sign Up, you are indicating that you have read the :privacy and agree to the :terms.", ['privacy' => $privacyLink, 'terms' => $termLink]));
		}
	}
}
?>