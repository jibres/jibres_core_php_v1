<?php
namespace content_love\email;


class controller
{
	public static function routing()
	{
		if(\dash\url::child())
		{
			switch (\dash\url::child())
			{
				case 'verify':
					$args = \dash\email\template::verify(true, 'you@email.com', 'Javad Adib', 'https://jibres.ir/about');

					echo $args['body'];
					\dash\code::boom();
					break;

				default:
					break;
			}
		}
	}
}
?>
