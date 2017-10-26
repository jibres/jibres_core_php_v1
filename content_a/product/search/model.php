<?php
namespace content_a\product\search;
use \lib\utility;
use \lib\debug;

class model extends \content_a\main\model
{

	/**
	 * Gets the list product.
	 *
	 * @return     <type>  The list product.
	 */
	public function getListProduct()
	{
		return \lib\app\product::list();
	}
}
?>