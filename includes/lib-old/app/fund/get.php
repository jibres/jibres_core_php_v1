<?php
namespace lib\app\fund;


trait get
{

	/**
	 * Gets the fund.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The fund.
	 */
	public static function get($_id, $_options = [])
	{
		if(!$_id || !\dash\coding::is($_id))
		{
			return false;
		}

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Thirdparty id not set"));
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\notif::error(T_(":store not found"));
			return false;
		}

		$get = \lib\db\funds::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(!$get)
		{
			\dash\notif::error(T_("Invalid fund id"));
			return false;
		}

		$result = self::ready($get);

		return $result;
	}


}
?>