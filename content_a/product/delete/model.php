<?php
namespace content_a\product\delete;
use \lib\utility;
use \lib\debug;

class model extends \content_a\product\model
{

	/**
	 * Posts an addproduct.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function post_delete($_args)
	{

		$url_product  = \lib\router::get_url(2);
		$post_product = \lib\utility::post('delete');

		if($url_product === $post_product)
		{
			\lib\app\product::delete($url_product);

			if(debug::$status)
			{
				$this->redirector($this->url('baseFull'). '/product');
			}
		}
		else
		{
			\lib\debug::error(T_("What are you doing?"));
			return false;
		}
	}
}
?>