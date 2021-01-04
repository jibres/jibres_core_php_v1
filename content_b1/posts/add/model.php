<?php
namespace content_b1\posts\add;


class model
{

	public static function post()
	{

		$args                   = [];
		$args['title']          = \dash\request::input_body('title');
		$args['seotitle']       = \dash\request::input_body('seotitle');
		$args['excerpt']        = \dash\request::input_body('excerpt');
		$args['subtitle']       = \dash\request::input_body('subtitle');
		$args['slug']           = \dash\request::input_body('slug');
		$args['content']        = \dash\request::input_body('content');
		$args['subtype']        = \dash\request::input_body('subtype');
		$args['comment']        = \dash\request::input_body('comment');
		$args['status']         = \dash\request::input_body('status');
		$args['specialaddress'] = \dash\request::input_body('specialaddress');
		$args['publishdate']    = \dash\request::input_body('publishdate');
		$args['publishtime']    = \dash\request::input_body('publishtime');
		$args['redirecturl']    = \dash\request::input_body('redirecturl');
		$args['tagurl']         = \dash\request::input_body('tagurl');
		$args['tag']            = \dash\request::input_body('tag');


		$result = \dash\app\posts\add::add($args);

		\content_b1\tools::say($result);
	}

}
?>