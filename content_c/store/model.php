<?php
namespace content_c\store;
use \lib\debug;
use \lib\utility;

class model extends \content_c\main\model
{
	/**
	 * Gets the list store.
	 *
	 * @return     <type>  The list store.
	 */
	public function getListStore()
	{
		return \lib\app\store::list();
	}
}
?>