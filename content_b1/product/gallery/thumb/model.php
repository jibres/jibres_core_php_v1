<?php
namespace content_b1\product\gallery\thumb;


class model
{
	public static function put()
	{
		$id = \dash\request::get('id');

		$fileid = \content_b1\tools::input_body('fileid');

		if(!$fileid || !is_numeric($fileid))
		{
			\content_b1\tools::stop(400, T_("File id is required"));
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