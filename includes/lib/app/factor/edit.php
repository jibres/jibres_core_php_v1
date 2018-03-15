<?php
namespace lib\app\factor;


trait edit
{
	/**
	 * edit a factor
	 *
	 * @param      <type>   $_factor  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function edit($_id, $_factor, $_factor_detail, $_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		\lib\app::variable($_factor);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \lib\app::request(),
			]
		];

		$id = \lib\utility\shortURL::decode($_id);

		if(!$id || !is_numeric($id))
		{
			\lib\app::log('api:factor:method:put:id:not:set', \lib\user::id(), $log_meta);
			if($_option['debug']) \lib\debug::error(T_("Id not set"));
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\app::log('api:factor:edit:store:id:not:set', \lib\user::id(), $log_meta);
			if($_option['debug']) \lib\debug::error(T_("Id not set"));
			return false;
		}

		$load_factor = \lib\db\factors::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(empty($load_factor) || !$load_factor || !isset($load_factor['id']))
		{
			\lib\app::log('api:factor:edit:factor:not:found', \lib\user::id(), $log_meta);
			if($_option['debug']) \lib\debug::error(T_("Can not access to edit it"), 'factor', 'permission');
			return false;
		}

		\lib\db\factordetails::remove_factor($load_factor['id']);

		$return = \lib\app\factor::add($_factor, $_factor_detail, ['factor_id' => $load_factor['id'], 'debug' => false]);

		if(\lib\debug::$status)
		{
			\lib\debug::true(T_("Your factor successfully updated"));
		}

		return $return;
	}
}
?>
