<?php
namespace content_a\product\add;
use \lib\utility;
use \lib\debug;

class model extends \content_a\main\model
{

	/**
	 * Gets the post.
	 *
	 * @return     array  The post.
	 */
	public static function getPost()
	{
		$args =
		[
			'title' => utility::post('title'),
			'name'  => utility::post('name'),
		];

		return $args;
	}


	/**
	 * Posts an addproduct.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function post_add($_args)
	{
		\lib\app\product::add(self::getPost());

		if(debug::$status)
		{
			$this->redirector($this->url('baseFull'). '/product');
		}

	}
}
?>