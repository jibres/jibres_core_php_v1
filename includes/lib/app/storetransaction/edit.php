<?php
namespace lib\app\storetransaction;


trait edit
{
	/**
	 * edit a storetransaction
	 *
	 * @param      <type>   $_storetransaction  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function edit($_id, $_storetransaction, $_storetransaction_detail, $_option = [])
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

		\dash\app::variable($_storetransaction);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \dash\app::request(),
			]
		];

		$id = \dash\coding::decode($_id);

		if(!$id || !is_numeric($id))
		{
			\dash\app::log('api:storetransaction:method:put:id:not:set', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Id not set"));
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\app::log('api:storetransaction:edit:store:id:not:set', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Id not set"));
			return false;
		}

		$load_storetransaction = \lib\db\storetransactions::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(empty($load_storetransaction) || !$load_storetransaction || !isset($load_storetransaction['id']))
		{
			\dash\app::log('api:storetransaction:edit:storetransaction:not:found', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Can not access to edit it"), 'storetransaction', 'permission');
			return false;
		}

		\lib\db\storetransactiondetails::remove_storetransaction($load_storetransaction['id']);

		$return = \lib\app\storetransaction::add($_storetransaction, $_storetransaction_detail, ['storetransaction_id' => $load_storetransaction['id'], 'debug' => false]);

		if(\lib\engine\process::status())
		{
			\dash\notif::ok(T_("Your storetransaction successfully updated"));
		}

		return $return;
	}
}
?>
