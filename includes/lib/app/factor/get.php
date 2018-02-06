<?php
namespace lib\app\factor;
use \lib\debug;

trait get
{


	/**
	 * Gets the factor.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The factor.
	 */
	public static function get($_args, $_option = [])
	{
		\lib\app::variable($_args);

		$default_option =
		[
			'debug'       => true,
			'only_factor' => false,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		if(!\lib\user::id())
		{
			\lib\app::log('api:factor:user:id:not:found', \lib\user::id(), \lib\app::log_meta());
			if($_option['debug']) debug::error(T_("User id not found"));
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\app::log('api:factor:store:id:not:found', \lib\user::id(), \lib\app::log_meta());
			if($_option['debug']) debug::error(T_("Store id not found"));
			return false;
		}


		$id = \lib\app::request("id");
		$id = \lib\utility\shortURL::decode($id);
		if(!$id)
		{
			\lib\app::log('api:factor:id:shortname:not:set', \lib\user::id(), \lib\app::log_meta());
			if($_option['debug']) debug::error(T_("Store id or shortname not set"), 'id', 'arguments');
			return false;
		}

		if($_option['only_factor'])
		{
			$result = \lib\db\factors::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);
			$result = self::ready($result);
		}
		else
		{
			$result = \lib\db\factors::get_print($id, \lib\store::id());

			if(isset($result['factor']))
			{
				$result['factor'] = self::ready($result['factor']);
			}

			if(isset($result['factor_detail']) && is_array($result['factor_detail']))
			{
				$temp = [];
				foreach ($result['factor_detail'] as $key => $value)
				{
					$temp[] = self::ready($value);
				}
				$result['factor_detail'] = $temp;
			}
		}

		return $result;
	}
}
?>