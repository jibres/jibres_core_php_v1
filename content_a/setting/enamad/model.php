<?php
namespace content_a\setting\enamad;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			$post['enamad'] = null;
		}
		else
		{
			$enamad = null;
			if(isset($_POST['enamad']) && is_string($_POST['enamad']))
			{
				$enamad = $_POST['enamad'];
			}

			if(!$enamad)
			{
				\dash\notif::error(T_("Enamad Script is required"), 'enamad');
				return false;
			}

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
		}

		\lib\app\store\edit::selfedit($post);

		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}


}
?>