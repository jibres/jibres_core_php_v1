<?php
namespace content_cms\posts\setting;

class view
{
	public static function config()
	{

		\dash\face::title(T_("Edit post setting"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). '/edit'. \dash\request::full_get());

		$postWriter = \dash\app\posts\get::post_writer_list();
		\dash\data::postWriter($postWriter);

		if(!in_array(\dash\data::dataRow_user_id(), array_column($postWriter, 'id')))
		{
			\dash\data::postWriterOld(\dash\app\user::get(\dash\data::dataRow_user_id()));
		}

	}
}
?>