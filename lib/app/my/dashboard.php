<?php
namespace lib\app\my;


class dashboard
{
	public static function detail()
	{
		if(!\dash\user::id())
		{
			return false;
		}

		$user_id = \dash\user::id();

		$result                 = [];
		$result['budget']       = \dash\user::budget();

		// load in master veiw
		$listStore = \dash\data::listStore();
		$store_count = 0;
		if(isset($listStore['owner']) && is_array($listStore['owner']))
		{
			$store_count = count($listStore['owner']);
		}

		$result['store_count']  = $store_count;

		$domain_count = floatval(\lib\app\nic_domain\search::get_my_active_count($user_id));

		$result['domain_count'] = $domain_count;

		$firstpay     = \dash\db\transactions\get::first_pay_user($user_id);

		$firstrenew   = \lib\db\nic_domainaction\get::firstrenew_user($user_id);

		$firstproduct = \lib\db\store\get::user_first_product($user_id);
		$firstorder   = \lib\db\store\get::user_first_order($user_id);

		$avatar = \dash\user::detail('avatar');

		if(strpos($avatar, 'img/avatar/') !== false)
		{
			$avatar = null;
		}

		$verify_email = false;
		if(\dash\user::email_list(true))
		{
			$verify_email = true;
		}

		$result['complete_profile'] =
		[
			'mobile'       => \dash\user::detail('verifymobile') ? true : false,
			'email'        => $verify_email,
			'username'     => \dash\user::detail('username') ? true : false,
			'birthday'     => \dash\user::detail('birthday') ? true : false,
			'avatar'       => $avatar ? true : false,
			'firststore'   => $store_count ? true : false,
			'firstproduct' => $firstproduct ? true : false,
			'firstorder'   => $firstorder ? true : false,
			'firstdomain'  => $domain_count ? true : false,
			'firstrenew'   => $firstrenew ? true : false,
			'firstpay'     => $firstpay ? true : false,
		];



		$result['complete_profile']['percent'] = round((count(array_filter($result['complete_profile'])) * 100) / count($result['complete_profile']));


		// var_dump($result);exit();

		return $result;
	}

}
?>