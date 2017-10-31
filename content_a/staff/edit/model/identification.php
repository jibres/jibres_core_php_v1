<?php
namespace content_a\staff\edit\model;
use \lib\utility;
use \lib\debug;

trait identification
{
	public function post_staff_identification($_args)
	{
		$id                           = isset($_args->match->url[0][1]) ? $_args->match->url[0][1] : null;

		$request                      = [];
		// $request['nationality']    = utility::post('');
		$request['birthplace']        = utility::post('birthplace');
		$request['shfrom']            = utility::post('issueplace');
		$request['shcode']            = utility::post('id');
		$request['passportcode']      = utility::post('passport');
		$request['passportexpire']    = utility::post('passportexpire');
		$request['nationalcode']      = utility::post('nid');
		$request['id']                = $id;

		utility::set_request_array($request);

		$result = $this->add_staff(['method' => 'patch', 'debug' => true]);

	}
}
?>
