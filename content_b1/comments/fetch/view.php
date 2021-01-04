<?php
namespace content_b1\comments\fetch;


class view
{

	public static function config()
	{
		$args =
		[
			'order'      => \dash\request::get('order'),
			'sort'       => \dash\request::get('sort'),
			'status'     => \dash\request::get('status'),
			'post_id'    => \dash\request::get('post_id'),
			'product_id' => \dash\request::get('product_id'),
			'for'        => \dash\request::get('for'),
		];

		if(\dash\request::get('answerto'))
		{
			$args['parent']     = \dash\request::get('answerto');
			$args['product_id'] = null;
			$args['post_id']    = null;
			$args['for']        = null;
		}


		$result      = \dash\app\comment\search::list(\dash\request::get('q'), $args);

		\dash\notif::meta(['is_filtered' => \dash\app\comment\search::is_filtered()]);

		\content_b1\tools::say($result);
	}
}
?>