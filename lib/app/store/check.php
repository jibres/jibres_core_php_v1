<?php
namespace lib\app\store;


class check
{

	public static function industry_list()
	{
		return
		[
			'do_not_know'      => T_('I haven’t decided yet'),
			'beauty'           => T_('Beauty'),
			'clothing'         => T_('Clothing'),
			'electronics'      => T_('Electronics'),
			'furniture'        => T_('Furniture'),
			'handcrafts'       => T_('Handcrafts'),
			'jewelry'          => T_('Jewelry'),
			'painting'         => T_('Painting'),
			'photography'      => T_('Photography'),
			'restaurants'      => T_('Restaurants'),
			'groceries'        => T_('Groceries'),
			'other_food_drink' => T_('Other food and drink'),
			'sports'           => T_('Sports'),
			'toys'             => T_('Toys'),
			'services'         => T_('Services'),
			'virtual_services' => T_('Virtual services'),
			'charity'          => T_('Charity'),
			'personal_website' => T_('Personal website'),
			'company_website'  => T_('Company website'),
			'university'       => T_('University'),
			'wiki'             => T_('Wiki'),
			'other'            => T_('Other'),
		];
	}


	public static function variable($_args, $_option = [])
	{
		$default_option =
		[
			'debug'   => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		$condition =
		[
			'title'                               => 'title',
			'shorttitle'                          => 'string_20',
			'website'                             => 'website',
			'desc'                                => 'desc',
			'logo'                                => 'string_300',
			'lang'                                => 'language',
			'status'                              => ['enum' => ['enable', 'disable', 'close']],
			'address'                             => 'address',
			'phone'                               => 'phone',
			'mobile'                              => 'mobile',
			'google_analytics'                    => 'string_50',
			'addon_hotjar'                        => 'string_20',
			'addon_tawk'                          => 'string_50',
			'addon_tidio'                         => 'string_50',
			'addon_crisp'                         => 'string_50',
			'addon_imber'                         => 'string_50',
			'addon_raychat'                       => 'string_50',
			'addon_mediaad'                       => 'intstring_10_4',
			'addon_goftino'                       => 'string_50',
			'enamad'                              => 'string_100',
			'nosale'                              => 'bit',
			'samandehi_link1'                     => 'url',
			'samandehi_link2'                     => 'url',

			'industry'                            => ['enum' => array_keys(self::industry_list())],

			'redirect_all_domain_to_master'       => 'bit',
			'redirect_jibres_subdomain_to_master' => 'bit',
			'special_upload_provider'             => 'bit',

			'enterdisallow'                       => 'bit',
			'entersignupdisallow'                 => 'bit',
			'forceloginorder'                     => 'bit',

			'torob_api'                           => 'bit',

			'homepage_builder_post_id'            => 'id',

			'force_stop_sitebuilder_auto_save'    => 'bit',

			'satisfaction_survey'                 => 'id',
			'shipping_survey'                     => 'id',
			'order_schedule'                      => 'json',

			'disallowsearchengine'                => 'yes_no',
		];

		$require = ['title'];

		$meta =	[];


		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if($data['title'])
		{
			if(substr_count($data['title'], ' ') > 8)
			{
				\dash\notif::error(T_("You can use less than 8 space character in business name"));
				return false;
			}
		}


		if($data['google_analytics'])
		{
			if(!preg_match("/^[A-Za-z0-9\-]+$/", $data['google_analytics']))
			{
				\dash\notif::error(T_("Only Latin letter and number can use in google analytics code"), 'google_analytics');
				return false;
			}
		}

		return $data;
	}

}
?>