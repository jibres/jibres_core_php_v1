<?php
namespace content_cms\files\choose;


class model
{
	public static function post()
	{
		$fileid = \dash\request::post('fileid');

		if(!$fileid)
		{
			\dash\notif::error(T_("Please choose a file"));
			return false;
		}

		if(\dash\request::get('related') === 'poststhumb' && \dash\request::get('related_id'))
		{
			$back_link = \content_cms\files\choose\view::call_back_link();

			$file_path = \dash\upload\cms::set_post_thumb_by_file_id(\dash\coding::decode(\dash\request::get('related_id')), $fileid);

			if($file_path)
			{
				\dash\app\posts\edit::edit(['thumb' => $file_path], \dash\request::get('related_id'));
				\dash\redirect::to($back_link);
			}
			return;

		}
		elseif(\dash\request::get('related') === 'postsgallery' && \dash\request::get('related_id'))
		{
			$back_link = \content_cms\files\choose\view::call_back_link();

			$file_detail = \dash\upload\cms::set_post_gallery_by_file_id(\dash\coding::decode(\dash\request::get('related_id')), $fileid);
			if($file_detail)
			{
				\dash\app\posts\gallery::gallery(\dash\request::get('related_id'), $file_detail, 'add');
				if(\dash\engine\process::status())
				{
					\dash\redirect::to($back_link);
				}
			}
			return;

		}
		elseif(\dash\request::get('related') === 'postscover' && \dash\request::get('related_id'))
		{
			$back_link = \content_cms\files\choose\view::call_back_link();

			$file_path = \dash\upload\cms::set_post_cover_by_file_id(\dash\coding::decode(\dash\request::get('related_id')), $fileid);

			if($file_path)
			{
				\dash\app\posts\edit::edit(['cover' => $file_path], \dash\request::get('related_id'));
				\dash\redirect::to($back_link);
			}
			return;

		}
		else
		{
			\dash\notif::error(T_("This method is not allowed"));
			return false;
		}
	}

}
?>