<?php
namespace content_v2\product\gallery\remove;


class model
{
	public static function delete()
	{
		$id = \dash\request::get('id');

		$fileid = \content_v2\tools::input_body('fileid');

		if(!$fileid || !is_numeric($fileid))
		{
			\content_v2\tools::stop(400, T_("File id is required"));
		}

		$result = \lib\app\product\gallery::gallery($id, $fileid, 'remove');

		if($result)
		{
			\dash\notif::ok(T_("File removed from gallery"));
		}

		\content_v2\tools::say($result);

	}


}
?>