<?php
namespace content_a\setting\general;
use \lib\debug;
use \lib\utility;

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
			'name'    => utility::post('name'),
			'slug'    => utility::post('slug'),
			'website' => utility::post('website'),
			'desc'    => utility::post('desc'),
		];
		return $args;
	}


	/**
	 * Posts an add.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function post_general($_args)
	{
		\lib\app\store::edit(self::getPost());

		if(debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>