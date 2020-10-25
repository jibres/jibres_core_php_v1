<?php
namespace content_a\form\tag\edit;


class model
{
	public static function post()
	{



		$id = \dash\request::get('tid');

		if(\dash\request::post('delete') === 'delete')
		{
			\lib\app\form\tag\remove::remove($id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). \dash\request::fix_get(null, true));
			}
			return;
		}


		$args                  = [];
		$args['title']   = \dash\request::post('title');
		$args['desc']    = \dash\request::post_raw('desc');
		$args['slug']    = \dash\request::post('slug');
		$args['privacy'] = \dash\request::post('privacy');


		$result = \lib\app\form\tag\edit::edit($args, $id);

		$add_form_id = \dash\request::post('add_form_id');

		if($add_form_id)
		{
			\lib\app\form\tag\add::form_tag_plus(\dash\request::get('tid'), $add_form_id);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>