<?php
namespace lib\app\thirdparty;


trait get
{

	/**
	 * Gets the thirdparty.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The thirdparty.
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
			\lib\notif::error(T_("Thirdparty id not set"));
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\notif::error(T_(":store not found"));
			return false;
		}

		$get = \lib\db\userstores::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(!$get)
		{
			\lib\notif::error(T_("Invalid thirdparty id"));
			return false;
		}

		$result = self::ready($get);

		return $result;
	}


}
?>