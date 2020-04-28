<?php
namespace lib\app\shaparak\acceptor;


class add
{
	public static function new_acceptor($_user_id)
	{
		$insert =
		[
			'user_id'                        => $_user_id,
			'iin'                            => \lib\shaparak\acceptor::get_iin(),
			'acceptorCode'                   => null,
			'acceptorType'                   => 2,
			'facilitatorAcceptorCode'        => \lib\shaparak\acceptor::get_facilitatorAcceptorCode(),
			'cancelable'                     => 0,
			'refundable'                     => 0,
			'blockable'                      => 0,
			'chargeBackable'                 => 0,
			'settledSeparately'              => 0,
			'allowScatteredSettlement'       => 0,
			'acceptCreditCardTransaction'    => 0,
			'allowIranianProductsTrx'        => 0,
			'allowKaraCardTrx'               => 0,
			'allowGoodsBasketTrx'            => 0,
			'allowFoodSecurityTrx'           => 0,
			'allowJcbCardTrx'                => 0,
			'allowUpiCardTrx'                => 0,
			'allowVisaCardTrx'               => 0,
			'allowMasterCardTrx'             => 0,
			'allowAmericanExpressTrx'        => 0,
			'allowOtherInternationaCardsTrx' => 0,
			'Description'                    => null,
			'datecreated'                    => date("Y-m-d H:i:s"),
		];

		$acceptor_id = \lib\db\shaparak\acceptor\insert::new_record($insert);

		$acceptorCode = 'Jibres-'. str_pad((string) $acceptor_id, 8, "0", STR_PAD_LEFT);

		\lib\db\shaparak\acceptor\update::update(['acceptorCode' => $acceptorCode], $acceptor_id);

		$insert['acceptorCode'] = $acceptorCode;

		return $insert;

	}
}
?>