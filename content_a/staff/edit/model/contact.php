<?php
namespace content_a\staff\edit\model;
use \lib\utility;
use \lib\debug;

trait contact
{
	public function post_staff_contact($_args)
	{

		$id                = isset($_args->match->url[0][1]) ? $_args->match->url[0][1] : null;

		$request           = [];
		$request['mobile'] = utility::post('staff-mobile');
		$request['email']  = utility::post('email');
		$request['id']     = $id;

		$meta              = [];
		$meta['phone']     = utility::post('phone');

		$meta = \lib\utility\safe::safe($meta);

		utility::set_request_array($request);

		$result = $this->add_staff(['method' => 'patch', 'debug' => true, 'meta' => ['tel' => $meta]]);


	}
}
?>