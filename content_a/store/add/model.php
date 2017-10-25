<?php
namespace content_a\store\add;
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
		$post         = [];
		$post['name'] = utility::post('name');
		$post['slug'] = utility::post('slug');
		$post['desc'] = utility::post('desc');

  		return $post;
	}

	/**
	 * Posts an add.
	 */
	public function post_add()
	{
		\lib\app\store::add(self::getPost());

		if(debug::$status)
		{
			$this->redirector($this->url('baseFull'));
		}
	}
}
?>