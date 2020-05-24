<?php
namespace lib\app\sync;

/**
 * This class describes logo.
 */
class tools
{

	/**
	 * Start sync logo from stores to jibres
	 */
	public static function add($_query, $_fuel, $_title = null)
	{
		$run_first_time = self::run_sync($_query, $_fuel);
		if($run_first_time)
		{
			return $run_first_time;
		}
		// @todo @reza
		return false;

		$add                = [];
		$add['query']       = addslashes($_query);
		$add['fuel']        = $_fuel;
		$add['title']       = $_title;
		$add['datecreated'] = date("Y-m-d H:i:s");
		$add['status']      = 'pending';

		$sync_id = \lib\db\sync\insert::new_record($add);
		if(!$sync_id)
		{
			\dash\log::set('dbCanNotAddSync');
		}

		\dash\db::query("Sync Error");
	}


	public static function run_sync($_query, $_fuel)
	{
		$result = \dash\db::query($_query, $_fuel);
		return $result;
	}

}
?>