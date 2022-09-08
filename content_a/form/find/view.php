<?php
namespace content_a\form\find;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Find answer and print'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this() . '/edit?id=' . \dash\request::get('id'));

		$form_id = \dash\request::get('id');
		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_before(__DIR__ . '/display-before.php');
		// \dash\data::listEngine_filter(\lib\app\form\answer\filter::list());
		// \dash\data::listEngine_sort(true);
		// \dash\data::sortList(\lib\app\form\answer\filter::sort_list());
		\dash\data::listEngine_cleanFilterUrl(\dash\url::current() . '?id=' . $form_id);

		$args            = [];
		$args['form_id'] = $form_id;
		//		$args['sort']        = \dash\request::get('sort');
		//		$args['order']       = \dash\request::get('order');

		if(a(\dash\data::formDetail(), 'resultpagesetting', 'tag_id'))
		{
			$args['tag_id'] = a(\dash\data::formDetail(), 'resultpagesetting', 'tag_id');
		}

		$args['not_deleted'] = true;
		$q                   = \dash\validate::search_string();


		$answerList = \lib\app\form\answer\search::list($q, $args, true);

		if(!$answerList)
		{
			$answerList = [];
		}

		$load_items = \lib\app\form\item\get::items($form_id);

		$result        = [];
		$allowShowItem = [];
		if(is_array(a(\dash\data::formDetail(), 'resultpagesetting', 'question')))
		{
			$allowShowItem = a(\dash\data::formDetail(), 'resultpagesetting', 'question');
			$allowShowItem = array_map('floatval', $allowShowItem);
		}

		if(\dash\url::isLocal())
		{
			$allowShowItem = array_column($load_items, 'id');
		}
		elseif(\lib\app\form\form\get::enterpriseSpecialFormBuilder())
		{
			$allowShowItem = array_column($load_items, 'id');
		}


		foreach ($load_items as $key => $item)
		{
			if(!in_array(floatval($item['id']), $allowShowItem))
			{
				unset($load_items[$key]);
			}
		}

		$col   = [];
		$clone = [];
		foreach ($load_items as $load_item)
		{
			$clone[$load_item['id']] = null;
			$col[$load_item['id']]   =
				[
					'title' => $load_item['title'],
				];

		}

		$result = [];

		foreach ($answerList as $answer)
		{
			$loadAnswerDetailargs                 = [];
			$loadAnswerDetailargs['answer_id']    = $answer['id'];
			$loadAnswerDetailargs['form_id']      = $form_id;
			$loadAnswerDetailargs['sort_by_item'] = true;

			$getAnserDetailList = \lib\db\form_answer\get::for_result_page($form_id, $answer['id'], $allowShowItem);
			if(!is_array($getAnserDetailList))
			{
				$getAnserDetailList = [];
			}

			foreach ($getAnserDetailList as $oneAnswerDetail)
			{
				if(!isset($result[$answer['id']]))
				{
					$result[$answer['id']] = $clone;
				}

				$myAnswer = $oneAnswerDetail['answer'];

				if($myAnswer)
				{
					switch ($oneAnswerDetail['type'])
					{
						case 'short_answer':
							//						$myAnswer = $myAnswer;
							break;
						case 'yes_no':
							if($myAnswer)
							{
								$myAnswer = T_($myAnswer);
							}
							break;

						case 'nationalcode':
							// $myAnswer = substr($myAnswer, 0, 3) . ' * * * * * ' . substr($myAnswer, 8, 2);
							$myAnswer = \dash\fit::text($myAnswer);
							$myAnswer = '<div class="ltr ">' . $myAnswer . '</div>';

							break;
						case 'birthdate':

							break;
						case 'displayname':
							break;
						case 'mobile':
							// $myAnswer = substr($myAnswer, 0, 5) . ' * * * * ' . substr($myAnswer, 8, 4);
							$myAnswer = \dash\fit::text($myAnswer);
							$myAnswer = '<div class="ltr ">' . $myAnswer . '</div>';
							break;
						default:

							break;
					}
				}

				$result[$answer['id']][$oneAnswerDetail['item_id']] = $myAnswer;

			}


		}

		\dash\data::col($col);
		\dash\data::dataTable($result);

	}




}

?>
