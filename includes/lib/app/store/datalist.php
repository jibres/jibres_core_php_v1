<?php
namespace lib\app\store;

trait datalist
{
	/**
	 * Gets the store.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The store.
	 */
	public static function list($_args = [])
	{
		if(!\lib\user::id())
		{
			return false;
		}

		$meta            = [];
		if(array_key_exists('pagenation', $_args))
		{
			$meta['pagenation'] = $_args['pagenation'];
			unset($_args['pagenation']);
		}

		$meta['creator'] = \lib\user::id();
		$result          = \lib\db\stores::search(\lib\user::id(), $meta);
		$temp            = [];
		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}
}
?>