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
	public static function add($_query, $_fuel)
	{
		$add                = [];
		$add['query']       = addslashes($_query);
		$add['fuel']        = $_fuel;
		$add['datecreated'] = date("Y-m-d H:i:s");
		$add['status']      = 'pending';

		$sync_id = \lib\db\sync\insert::new_record($add);
		if(!$sync_id)
		{
			\dash\log::set('dbCanNotAddSync');
		}

		$run_first_time = self::run_sync($_query, $_fuel);
		if($run_first_time)
		{
			\lib\db\sync\update::status('success', $sync_id);
		}

	}


	public static function run_sync($_query, $_fuel)
	{
		$result = \dash\db::query($_query, $_fuel);
		return $result;
	}

}
?>