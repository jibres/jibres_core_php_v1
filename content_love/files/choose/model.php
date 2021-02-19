<?php
namespace content_love\files\choose;


class model
{
	public static function post()
	{
		$fileid = \dash\request::post('fileid');
		$related = \dash\request::get('related');
		$related_id = \dash\request::get('related_id');


		if(!$fileid)
		{
			\dash\notif::error(T_("Please choose a file"));
			return false;
		}

		if($related === 'poststhumb' && $related_id)
		{
			$back_link = \content_love\files\choose\view::call_back_link();

			$file_path = \dash\upload\cms::set_post_thumb_by_file_id(\dash\coding::decode($related_id), $fileid);

			if($file_path)
			{
				\dash\app\posts\edit::edit(['thumb' => $file_path], $related_id);
				\dash\redirect::to($back_link);
			}
			return;

		}
		elseif(in_array($related, ['postsgallery', 'postsgalleryvideo', 'postsgalleryaudio']) && $related_id)
		{
			$back_link = \content_love\files\choose\view::call_back_link();

			$file_detail = \dash\upload\cms::set_post_gallery_by_file_id(\dash\coding::decode($related_id), $fileid, $related);
			if($file_detail)
			{
				\dash\app\posts\gallery::gallery($related_id, $file_detail, 'add_auto');
				if(\dash\engine\process::status())
				{
					\dash\redirect::to($back_link);
				}
			}
			return;

		}
		elseif($related === 'postscover' && $related_id)
		{
			$back_link = \content_love\files\choose\view::call_back_link();

			$file_path = \dash\upload\cms::set_post_cover_by_file_id(\dash\coding::decode($related_id), $fileid);

			if($file_path)
			{
				\dash\app\posts\edit::edit(['cover' => $file_path], $related_id);
				\dash\redirect::to($back_link);
			}
			return;

		}
		else
		{
			\dash\notif::error(T_("This method is not allowed"));
			\dash\redirect::to(\dash\url::here());
			return false;
		}
	}

}
?>