<?php
namespace content_a\sale;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Sale invoicing'));
		// \dash\data::page_desc(T_('Sale your product via Jibres and enjoy using integrated web base platform.'));
		\dash\data::page_pictogram('cart-shopping-1');

		if(\dash\permission::check('factorSaleList'))
		{
			\dash\data::badge_text(T_('Back to last sales'));
			\dash\data::badge_link(\dash\url::here(). '/factor?type=sale');
		}


		self::pc_pos();

	}


	private static function pc_pos()
	{

		// @check need to check default pc-pos
		// just for test and supersaeed
		// {
		// 	"ok": true,
		// 	"result": {
		// 	    "title": "کارتخوان ایران کیش",
		// 	    "name": "irkish",
		// 	    "class": "irkish",
		// 	    "pc_pos": {
		// 	        "serial": 11,
		// 	        "terminal": 22,
		// 	        "receiver": 33
		// 	    },
		// 	    "default": true
		// 	}
		// }
		// http://localhost:9759/jibres/?type=PcPosKiccc&serial=11&terminal=22&acceptor=33&port=&sum=1200

		$pos = \lib\store::detail('pos');
		if(is_string($pos))
		{
			$pos = json_decode($pos, true);
			if(isset($pos[0]))
			{
				$pos = $pos[0];

				\dash\data::posSetting($pos);
				if(isset($pos['pc_pos']))
				{
					$pc_pos   = $pos['pc_pos'];
					$serial   = isset($pc_pos['serial']) ? $pc_pos['serial'] : null;
					$terminal = isset($pc_pos['terminal']) ? $pc_pos['terminal'] : null;
					$receiver = isset($pc_pos['receiver']) ? $pc_pos['receiver'] : null;
					$link  = 'http://localhost:9759/jibres/?type=PcPosKiccc';
					$link .= '&serial='. $serial;
					$link .= '&terminal='. $terminal;
					$link .= '&acceptor='. $receiver;
					$link .= '&port=&sum=$';
					\dash\data::pcPosLink($link);
				}
			}
		}
	}
}
?>
