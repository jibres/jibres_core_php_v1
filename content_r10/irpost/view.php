<?php
namespace content_r10\irpost;


class view
{
	public static function config()
	{
		$irpostResult = [];
		$weight = \dash\request::get('w');
		$type = \dash\request::get('t');
		if(is_numeric($weight) && $type)
		{
			$meta                  = [];
			$meta['detail']        = 1;
			$meta['type']          = $type;
			$meta['package_type']  = \dash\request::get('p');
			$meta['from_province'] = \dash\request::get('p1');
			$meta['from_city']     = \dash\request::get('c1');
			$meta['send_type']     = \dash\request::get('sendtype');
			$meta['to_province']   = \dash\request::get('p2');
			$meta['to_city']       = \dash\request::get('c2');

			$irpostResult = \dash\utility\ir_post::calculate($weight, $meta);
			\dash\data::irpostResult($irpostResult);
		}
		else
		{
			\dash\notif::info(T_("To get document go to :val", ['val' => 'developers.jibres.'. \dash\url::tld()]));
		}

		\content_r10\tools::say($irpostResult);
	}
}
?>