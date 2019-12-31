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
			'ready/check'      => ['title' => 'Check something'],
			'ready/db'         => ['title' => 'Ready database to transfer'],
			'user/db'          => ['title' => 'Transfer users table'],
			'store/db'         => ['title' => 'Transfer store table'],
			'store/database'   => ['title' => 'Transfer customer database'],
			'store/userstore'  => ['title' => 'Transfer userstore'],
			'store/logo'       => ['title' => 'Transfer store logo'],
			'store/dash'       => ['title' => 'Transfer dash tables'],
			'product/ready'    => ['title' => 'Ready to transfer product'],
			'product/transfer' => ['title' => 'Transfer product'],
			'product/price'    => ['title' => 'Transfer product price'],
			'factor/transfer'  => ['title' => 'Transfer factors'],
		];

		\dash\data::myLink($level);



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
					\dash\redirect::to(\dash\url::here(). '/'.$next_url);
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