<?php
namespace lib\pardakhtyar;

class acceptor
{
	private static $switchKiccc                = 581672111;
	private static $codePazirandegiPardakhtYar = 371961754012345;


	public static function get_iin()
	{
		return self::$switchKiccc;
	}


	public static function get_facilitatorAcceptorCode()
	{
		return self::$codePazirandegiPardakhtYar;
	}

	/**
	 * [get description]
	 * @param  [type]  $_acceptor_code [description]
	 * @param  [type]  $_terminal      [description]
	 * @param  [type]  $_shaba         [description]
	 * @param  boolean $_isUpdate      [description]
	 * @return [type]                  [description]
	 */
	public static function get($_args, $_removeTerminal = null, $_removeShaba = null, $_isUpdate = false)
	{
		$myAcceptor =
		[
			[
				// require
				'iin'                            => self::$switchKiccc,

				'acceptorCode'                   => $_args['acceptorCode'],
				'acceptorType'                   => 2,

				'facilitatorAcceptorCode'        => self::$codePazirandegiPardakhtYar,

				// extra features
				'cancelable'                     => 'false',
				'refundable'                     => 'false',
				'blockable'                      => 'false',
				'chargeBackable'                 => 'false',

				// future
				'settledSeparately'              => 'false',
				'allowScatteredSettlement'       => 0,
				'acceptCreditCardTransaction'    => 'false',

				'allowIranianProductsTrx'        => 'false',

				// additional cards
				'allowKaraCardTrx'               => 'false',
				'allowGoodsBasketTrx'            => 'false',
				'allowFoodSecurityTrx'           => 'false',
				'allowJcbCardTrx'                => 'false',
				'allowUpiCardTrx'                => 'false',
				'allowVisaCardTrx'               => 'false',
				'allowMasterCardTrx'             => 'false',
				'allowAmericanExpressTrx'        => 'false',
				'allowOtherInternationaCardsTrx' => 'false',

				// terminal and shaba
				'terminals'                      => \lib\pardakhtyar\terminal::get(),
				'shaparakSettlementIbans'        => $_args['shaparakSettlementIbans'],

				'updateAction'                   => 0,
				// 'description' => 'acceptor of Jibres',
			]
		];

		// if need set terminal as null
		if($_removeTerminal === true)
		{
			$myAcceptor[0]['terminals'] = null;
		}

		if($_removeShaba)
		{
			$myAcceptor[0]['shaparakSettlementIbans'] = null;
		}

		if($_isUpdate)
		{
			$myAcceptor[0]['updateAction'] = 2;
		}

		return $myAcceptor;
	}

}
?>