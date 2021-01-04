<?php
namespace content_b1\product\gallery\thumb;


class model
{
	public static function put()
	{
		$id = \dash\request::get('id');

		$fileid = \dash\request::input_body('fileid');

		if(!$fileid)
		{
			\content_b1\tools::stop(400, T_("File id is required"));
		}

		if(!\dash\validate::code($fileid, false))
		{
			\content_b1\tools::stop(400, T_("File id is not valid"));
		}

		$result = \lib\app\product\gallery::setthumb($id, $fileid);
		if($result)
		{
			\dash\notif::ok(T_("Product thumb set"));
		}

		\content_b1\tools::say($result);

	}


}
?>