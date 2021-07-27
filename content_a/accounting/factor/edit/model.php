<?php
namespace content_a\accounting\factor\edit;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		if(\dash\request::post('changetemplate'))
		{
			$post =
			[
				'template' => \dash\request::post('changetemplate'),
			];

			$result = \lib\app\tax\doc\edit::edit($post, \dash\request::get('id'));
			\dash\redirect::pwd();
		}


		if(\dash\request::post('newlockstatus'))
		{
			$post =
			[
				'status' => \dash\request::post('newlockstatus'),
			];

			$result = \lib\app\tax\doc\edit::edit_status($post, \dash\request::get('id'));
			\dash\redirect::pwd();

		}


		if(\dash\request::post('uploaddoc') === 'uploaddoc' && \dash\request::files('gallery'))
		{
			\content_a\accounting\doc\edit\model::upload_gallery($id);
			return;
		}

		if(\dash\request::post('fileaction') === 'remove')
		{
			\content_a\accounting\doc\edit\model::remove_gallery($id);
			return false;
		}

		$post = \content_a\accounting\factor\add\model::getPost();

		$edit = \lib\app\tax\doc\template::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			$result = \lib\app\tax\doc\edit::edit_status(['status' => 'lock'], \dash\request::get('id'));

			\lib\app\tax\doc\edit::reset_number(['year_id' => a($post, 'year_id')]);

			\dash\redirect::pwd();
		}

	}

}
?>