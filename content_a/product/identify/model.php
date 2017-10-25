<?php
namespace content_a\product\identify;
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
			'barcode1'         => utility::post('barcode'),
			'rfid1'            => utility::post('rfid'),
			'qrcode1'          => utility::post('qrcode'),
		];

		return $args;
	}





	/**
	 * Posts an addproduct.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function post_identify($_args)
	{
		$this->user_id   = $this->login('id');
		$request         = $this->getPost();
		$product          = \lib\router::get_url(3);
		$request['id']   = $product;
		$request['team'] = $team = \lib\router::get_url(0);
		utility::set_request_array($request);

		// API ADD MEMBER FUNCTION
		$this->add_product(['method' => 'patch']);
		if(debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>