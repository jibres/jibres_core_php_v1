<?php
namespace content_b1\product\gallery\remove;


class model
{
	public static function delete()
	{
		$id = \dash\request::get('id');

		$fileid = \content_b1\tools::input_body('fileid');

		if(!$fileid)
		{
			\content_b1\tools::stop(400, T_("File id is required"));
		}

		if(!\dash\validate::code($fileid, false))
		{
			\content_b1\tools::stop(400, T_("File id is not valid"));
		}

		$result = \lib\app\product\gallery::gallery($id, $fileid, 'remove');

		if($result)
		{
			\dash\notif::ok(T_("File removed from gallery"));
		}

		\content_b1\tools::say($result);

	}


}
?>