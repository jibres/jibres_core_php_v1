<?php
namespace lib\app\tax\doc;


class balance
{

	public static function set($_doc_id)
	{
		\lib\db\tax_document\update::balance($_doc_id);
	}

}
?>