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
			'desc'            => 'string_300',
			'debtor'          => 'bigint',
			'creditor'        => 'bigint',
		];

		$require = ['tax_document_id', 'assistant_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$load_assistant = \lib\db\tax_coding\get::by_id($data['assistant_id']);
		if(isset($load_assistant['type']) && $load_assistant['type'] === 'assistant')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Invalid assistant id"));
			return false;
		}

		if(is_numeric($data['details_id']))
		{
			$load_assistant = \lib\db\tax_coding\get::by_id($data['assistant_id']);
			if(isset($load_assistant['type']) && $load_assistant['type'] === 'details')
			{
				// ok
			}
			else
			{
				\dash\notif::error(T_("Invalid details id"));
				return false;
			}
		}
		else
		{
			$add =
			[
				'title'  => $data['details_id'],
				'parent' => $load_assistant['id'],
				'type'   => 'details',
				'code'   => \lib\app\tax\coding\get::generate_code_details($data['assistant_id']),
			];

			$id = \lib\app\tax\coding\add::add($add);

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

		return $data;

	}

}
?>