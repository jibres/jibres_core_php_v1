<?php
namespace content_a\staff\edit\thumb;


class model extends \content_a\main\model
{
	public static function upload_file($_name)
	{
		if(\lib\utility::files($_name))
		{
			$uploaded_file = \lib\app\file::upload(['debug' => false, 'upload_name' => $_name]);

			if(isset($uploaded_file['url']))
			{
				return $uploaded_file['url'];
			}
			// if in upload have error return
			if(!\lib\debug::$status)
			{
				return false;
			}
		}
		return null;
	}


	public function post_thumb($_args)
	{

		$request = [];

		$nationalthumb = self::upload_file('nationalthumb');
		if($nationalthumb)
		{
			$request['nationalthumb'] = $nationalthumb;
		}

		$avatar = self::upload_file('avatar');
		if($avatar)
		{
			$request['avatar'] = $avatar;
		}

		if(!empty($request))
		{
			$request['id'] = \lib\utility::get('id');

			\lib\app\staff::edit($request);

			if(\lib\debug::$status)
			{
				$this->redirector($this->url('full'));
			}
		}
		else
		{
			\lib\debug::warn(T_("Not changed!"));
		}
	}
}
?>
