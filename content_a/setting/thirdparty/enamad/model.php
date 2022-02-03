<?php
namespace content_a\setting\thirdparty\enamad;


class model
{
	public static function post()
	{

		$enamad_static_file = \dash\request::post('enamad_static_file');

		$enamad_static_file = \dash\validate::staticfilename($enamad_static_file);

		$get = \lib\app\setting\tools::get('enamad', 'enamad_static_file');

		if(isset($get['value']) && $get['value'] && $get['value'] !== $enamad_static_file)
		{
			$post =
			[
				'filename'    => $get['value'],
			];

			$result = \lib\app\staticfile\remove::remove($post);
			// remove current static file
		}

		$get = \lib\app\setting\tools::update('enamad', 'enamad_static_file', $enamad_static_file);

		if($enamad_static_file)
		{
			$post =
			[
				'filename'    => $enamad_static_file,
				'filecontent' => null,
			];

			$result = \lib\app\staticfile\add::add($post);
			// set static file
		}

		\dash\notif::clean();

		if(\dash\request::post('remove') === 'remove')
		{
			$post['enamad'] = null;
		}
		else
		{
			$enamad = null;
			if(\dash\request::post_html())
			{
				$enamad = \dash\request::post_html();
			}

			if($enamad)
			{
				if(preg_match("/trustseal\.enamad\.ir\/\?id\=(\d+)(\&amp\;|\&)Code\=([^\"]+)/", $enamad, $split))
				{
					$post = [];
					$post['enamad'] = $split[1]. '_'. $split[3];
				}
				else
				{
					\dash\notif::error(T_("The text of enamad contains a series of special characters that are not in your text"), 'enamad');
					return false;
				}

				\lib\app\store\edit::selfedit($post);

			}

		}




		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}


}
?>