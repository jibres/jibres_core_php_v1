<?php
namespace content_a\product\edit;
use \lib\utility;
use \lib\debug;

class model extends \content_a\product\model
{

	/**
	 * Gets the post.
	 *
	 * @return     array  The post.
	 */
	public function getPost()
	{
		$args =
		[

			'allow_plus'       => utility::post('allowPlus'),
			'allow_minus'      => utility::post('allowMinus'),
			'remote_user'      => utility::post('remoteUser'),
			'24h'              => utility::post('24h'),
			// 'allow_desc_enter' => utility::post('allowDescEnter'),
			// 'allow_desc_exit'  => utility::post('allowDescExit'),
		];

		return $args;
	}





	/**
	 * Posts an addproduct.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function post_permission($_args)
	{
		$this->user_id   = $this->login('id');
		$request         = $this->getPost();
		$product          = \lib\router::get_url(3);
		$request['id']   = $product;
		$request['team'] = $team = \lib\router::get_url(0);
		utility::set_request_array($request);

		// API ADD MEMBER FUNCTION
		$this->add_product(['method' => 'patch']);
	}
}
?>