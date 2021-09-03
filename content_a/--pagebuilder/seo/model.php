<?php
namespace content_a\pagebuilder\seo;


class model
{
	public static function post()
	{
		$post = [];

		if(\dash\request::post('remove_cover') === 'remove_cover')
		{
			$post['cover'] = null;
		}

		if(\dash\request::files('cover'))
		{
			$file_cover = \dash\upload\cms::set_post_cover(\dash\coding::decode(\dash\request::get('id')), true);
			if(!$file_cover)
			{
				\dash\notif::error(T_("Please upload a photo"));
				return false;
			}
			$post['cover'] = $file_cover;
		}


		$post['set_seo']        = true;
		$post['slug']           = \dash\request::post('slug');
		$post['excerpt']        = \dash\request::post('excerpt');
		$post['seotitle']       = \dash\request::post('seotitle');
		$post['specialaddress'] = \dash\request::post('specialaddress');


		$post_detail = \dash\app\posts\edit::edit($post, \dash\request::get('id'), true);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>