<?php
namespace content_b1\posts\add;


class model
{

	public static function post()
	{
		$args                   = self::get_args();

		$result = \dash\app\posts\add::add($args);

		\content_b1\tools::say($result);
	}



	public static function get_args()
	{
		$args                   = [];
		if(\dash\request::isset_input_body('title')) 			$args['title']          = \dash\request::input_body('title');
		if(\dash\request::isset_input_body('seotitle')) 		$args['seotitle']       = \dash\request::input_body('seotitle');
		if(\dash\request::isset_input_body('excerpt')) 			$args['excerpt']        = \dash\request::input_body('excerpt');
		if(\dash\request::isset_input_body('subtitle')) 		$args['subtitle']       = \dash\request::input_body('subtitle');
		if(\dash\request::isset_input_body('slug')) 			$args['slug']           = \dash\request::input_body('slug');
		if(\dash\request::isset_input_body('content')) 			$args['content']        = \dash\request::input_body('content');
		if(\dash\request::isset_input_body('subtype')) 			$args['subtype']        = \dash\request::input_body('subtype');
		if(\dash\request::isset_input_body('comment')) 			$args['comment']        = \dash\request::input_body('comment');
		if(\dash\request::isset_input_body('status')) 			$args['status']         = \dash\request::input_body('status');
		if(\dash\request::isset_input_body('specialaddress')) 	$args['specialaddress'] = \dash\request::input_body('specialaddress');
		if(\dash\request::isset_input_body('publishdate')) 		$args['publishdate']    = \dash\request::input_body('publishdate');
		if(\dash\request::isset_input_body('publishtime')) 		$args['publishtime']    = \dash\request::input_body('publishtime');
		if(\dash\request::isset_input_body('redirecturl')) 		$args['redirecturl']    = \dash\request::input_body('redirecturl');
		if(\dash\request::isset_input_body('tagurl')) 			$args['tagurl']         = \dash\request::input_body('tagurl');
		if(\dash\request::isset_input_body('tags')) 			$args['tags']           = \dash\request::input_body('tags');
		return $args;
	}

}
?>