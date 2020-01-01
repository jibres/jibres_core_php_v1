<?php
namespace content_transfer\home;

class controller
{
	public static function routing()
	{
		self::step();

	}


	private static function step()
	{
		$module   = \dash\url::module();
		$child    = \dash\url::child();
		$subchild = \dash\url::subchild();
		$directory = \dash\url::directory();

		$level =
		[
			'product/price'      => ['title' => 'Fix product price'],
		];

		\dash\data::myLink($level);

		if(!$directory)
		{
			return;
		}

		if(!isset($level[$directory]))
		{
			\content_transfer\say::end('Invalid url');
		}
		else
		{
			$fn = str_replace('/', '\\', $directory);

			$name = "\\content_transfer\\_$fn";
			if(is_callable([$name, 'run']))
			{

				$name::run();

				$is_next = false;
				$next_url = null;
				foreach ($level as $url => $value)
				{
					if($is_next)
					{
						$next_url = $url;
						break;
					}

					if($url === $directory)
					{
						$is_next = true;
					}
				}

				if($next_url)
				{
					\content_transfer\say::end('Next step is: '. \dash\url::here(). '/'.$next_url);
					// \dash\redirect::to(\dash\url::here(). '/'.$next_url);
				}
				else
				{
					\content_transfer\say::end('Transfer complete');
				}
			}
			else
			{
				\content_transfer\say::end('Call to undefined function '. $name);
			}
		}


	}
}
?>