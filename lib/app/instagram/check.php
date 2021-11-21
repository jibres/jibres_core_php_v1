<?php
namespace lib\app\instagram;

class check
{

	public static function login_callback($_code, $_state)
	{
		$code = \dash\validate::string_500($_code);
		$state = \dash\validate::string_50($_state);

		if(!$code || !$state)
		{
			return false;
		}

		if(!\dash\validate::md5($state))
		{
			return false;
		}

		$load_token = \lib\db\instagram\get::by_token($state);

		if(!$load_token || !isset($load_token['store_id']))
		{
			return false;
		}


		$load_store = \lib\app\store\get::by_id($load_token['store_id']);
		if(!$load_store)
		{
			return false;
		}

		// $getOAuthToken =
		// [
		// 	'access_token' => 'IGQVJVb0l0RGZAWSklTa1NRcmpsbHRPMGhmM1BqanNhdHJkNTdwQjg4X2xsd2FpNG9CcXE0Rm10VjBXS2V0QVg3bzlPbUxmNFJ1bDRIUmRfbkZAZAc0FiWFg2RzJBX01acld4RWZAlMGhpZAG5oZAnRobC1Cc3hRMDlTd0ZAYZAFJ3',
		// 	'user_id' => 17841401959306742,
		// ];

		$getOAuthToken = \lib\api\instagram\api::getOAuthToken($code);
		if(!$getOAuthToken)
		{
			\dash\log::oops('instagramApiNullAccessToken');
			return false;
		}

		if(!isset($getOAuthToken['access_token']))
		{
			\dash\log::oops('cannotGetInstagramAccessToken');
			return false;
		}

		$args =
		[
			'access_token' => a($getOAuthToken, 'access_token'),
			'user_id'      => a($getOAuthToken, 'user_id'),
		];

		$api_result = \lib\api\business\api::set_instagram_detail($load_store['id'], $args);

		$result = [];

		$result['redirect'] = \dash\url::kingdom();

		if(a($load, 'pwd'))
		{
			$result['redirect'] = $load['pwd'];
		}

		return $result;

	}
}
?>