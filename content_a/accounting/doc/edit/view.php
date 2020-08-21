<?php
namespace content_a\accounting\doc\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Accounting Document Number'). ' '. \dash\data::dataRow_number());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());



		if(\dash\data::dataRow_status() === 'temp')
		{
			\dash\face::btnSave('formlock1');
			\dash\face::btnSaveValue('lock');
			\dash\face::btnSaveText(T_("Lock"));
		}
		elseif(\dash\data::dataRow_status() === 'lock')
		{
			\dash\face::btnInsert('formlock1');
			\dash\face::btnInsertValue('unlock');
			\dash\face::btnInsertText(T_("Unlock"));
		}

		\dash\data::maxUploadSize(\dash\upload\size::MB(1, true));

		\dash\data::myType(\dash\data::dataRow_type());
		\dash\data::editMode(true);

		$totalList = \lib\app\tax\coding\get::list_of('total');
		$totalList = array_column($totalList, 'title');
		\dash\data::totalList($totalList);
		\dash\data::assistantList(\lib\app\tax\coding\get::list_of('assistant'));

		\dash\data::detailsList(\lib\app\tax\coding\get::list_of('details'));

		\dash\face::btnDuplicate(\dash\url::that(). '/duplicate?id='. \dash\request::get('id'));

		$detail = \lib\app\tax\docdetail\get::list(\dash\request::get('id'));
		if(!is_array($detail))
		{
			$detail = [];
		}
		\dash\data::docDetail($detail);
		$desc = array_column($detail, 'desc');
		if(!array_filter($desc))
		{
			\dash\data::descEmpty(true);
		}


		$accountingSettingSaved = \lib\app\setting\get::accounting_setting();
		\dash\data::accountingSettingSaved($accountingSettingSaved);

		if(isset($accountingSettingSaved['currency']) && $accountingSettingSaved['currency'])
		{
			\dash\data::currentCurrency(\lib\currency::name($accountingSettingSaved['currency']));
		}


		\dash\data::accountingYear(\lib\app\tax\year\get::list());

		if($detail && is_array($detail))
		{
			$summary = [];
			$summary['debtor'] = array_sum(array_column($detail, 'debtor'));
			$summary['creditor'] = array_sum(array_column($detail, 'creditor'));

			if(floatval($summary['debtor']) === floatval($summary['creditor']))
			{
				\dash\data::equalICON('<i class="mLR5 sf-check-circle fc-green fs12 p0"></i>');
			}
			elseif(floatval($summary['debtor']) > floatval($summary['creditor']))
			{
				\dash\data::deptorICON('<i class="mLR5 sf-chevron-up fc-red"></i>');
				\dash\data::creditorICON('<i class="mLR5 sf-chevron-down"></i>');
			}
			elseif(floatval($summary['debtor']) < floatval($summary['creditor']))
			{
				\dash\data::creditorICON('<i class="mLR5 sf-chevron-up fc-red"></i>');
				\dash\data::deptorICON('<i class="mLR5 sf-chevron-down"></i>');
			}

			\dash\data::summary($summary);
		}



		if(\dash\request::get('calcvat'))
		{
			$number = \dash\request::get('calcvat');
			$number = \dash\validate::price($number);
			$number = floatval($number);
			if($number)
			{

				$vat = ($number * 6) / 9;

				$tax = $vat / 2;

				$vat = round($vat);
				$tax = round($tax);

				$get = \dash\request::get();
				unset($get['calcvat']);

				$vat_notif = T_("Vat"). ' ' . \dash\fit::number_decimal($vat);
				$get['value'] = $vat;
				$vat_notif = \dash\url::current(). '?'. http_build_query($get);
				\dash\data::vatCalc($vat_notif);
				\dash\data::vatValue($vat);


				$tax_notif = T_("Tax"). ' ' . \dash\fit::number_decimal($tax);
				$get['value'] = $tax;
				$tax_notif = \dash\url::current(). '?'. http_build_query($get);
				\dash\data::taxCalc($tax_notif);
				\dash\data::taxValue($tax);

			}


		}

	}
}
?>
