<?php
namespace lib\app\tax\docdetail;


class check
{

	public static function variable($_args)
	{
		$condition =
		[
			'tax_document_id' => 'int',
			'assistant_id'    => 'int',
			'details_id'      => 'string_300',
			'details_title'   => 'string_300',
			'desc'            => 'string_300',
			// 'debtor'       => 'float',
			// 'creditor'     => 'float',
			'type'            => ['enum' => ['debtor', 'creditor']],
			'value'           => 'float',

		];

		$require = ['tax_document_id','type', 'value', 'assistant_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$load_assistant = \lib\db\tax_coding\get::by_id($data['assistant_id']);
		if(isset($load_assistant['type']) && $load_assistant['type'] === 'assistant')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Invalid assistant id"), 'assistant_id');
			return false;
		}

		if($data['details_title'])
		{

			$load_details = \lib\db\tax_coding\get::by_title_assistant_id($data['details_title'], $load_assistant['parent1'], $load_assistant['parent2'], $load_assistant['id']);

			if(isset($load_details['id']))
			{
				$data['details_id'] = $load_details['id'];
			}
			else
			{

				$add =
				[
					'title'  => $data['details_title'],
					'parent' => $load_assistant['id'],
					'type'   => 'details',
					'code'   => \lib\app\tax\coding\get::generate_code_details($load_assistant['id']),
				];

				$id = \lib\app\tax\coding\add::add($add);
				// \dash\notif::clean();

				if(isset($id['id']))
				{
					$data['details_id'] = $id['id'];
				}
			}


			if(!$data['details_id'])
			{
				\dash\notif::error(T_("Please choose the details"));
				return false;
			}
		}
		else
		{
			if(isset($load_assistant['detailable']) && $load_assistant['detailable'])
			{
				\dash\notif::error(T_("Please choose the detail"));
				return false;
			}
			else
			{
				// the parent is detailable
				$data['details_id'] = null;
			}

		}


		if($data['type'] === 'debtor')
		{
			$data['debtor'] = $data['value'];
			$data['creditor'] = null;
		}
		elseif($data['type'] === 'creditor')
		{
			$data['creditor'] = $data['value'];
			$data['debtor'] = null;
		}
		else
		{
			\dash\notif::error(T_("Please set debtor or creditor"), ['element' => ['debtor', 'creditor']]);
			return false;
		}

		unset($data['value']);
		unset($data['type']);
		unset($data['details_title']);


		$load_doc = \lib\app\tax\doc\get::get($data['tax_document_id']);
		if(!isset($load_doc['id']))
		{
			\dash\notif::error(T_("Invalid accounting document id"));
			return false;
		}

		$data['year_id'] = \dash\get::index($load_doc, 'year_id');

		return $data;

	}

}
?>