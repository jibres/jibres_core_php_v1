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

		if(strpos($state, '-') === false)
		{
			return false;
		}

		$explode = explode('-', $state);

		if(!\dash\validate::store_code(a($explode, 0)))
		{
			return false;
		}

		if(!\dash\validate::md5(a($explode, 1)))
		{
			return false;
		}

		$load_store = \lib\app\store\get::by_code(a($explode, 0));

		if(!$load_store)
		{
			return false;
		}

		$db_name = \dash\engine\store::make_database_name(a($load_store, 'id'));

		$load = \lib\db\instagram\get::by_token_type($state, 'login', a($load_store, 'fuel'), $db_name);

		if(!$load)
		{
			return false;
		}

		$getOAuthToken = \lib\api\instagram\api::getOAuthToken($code);

		if(!$getOAuthToken)
		{
			\dash\log::oops('cannotGetInstagramAccessToken');
			return false;
		}

		$access_token = null;
		$user_id      = null;

		if(isset($getOAuthToken->access_token))
		{
			$access_token = $getOAuthToken->access_token;
			\lib\db\setting\update::overwirte_cat_key_fuel($access_token, 'instagram', 'access_token', $load_store['fuel'], $db_name);
		}

		if(isset($getOAuthToken->user_id))
		{
			$user_id = $getOAuthToken->user_id;
			\lib\db\setting\update::overwirte_cat_key_fuel($user_id, 'instagram', 'user_id', $load_store['fuel'], $db_name);
		}


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