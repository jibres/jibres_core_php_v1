<?php
namespace dash;


class seo
{
	public static function analyze($_detail)
	{
		$seo = [];

		$seo['title']           = self::analyze_title($_detail);
		$seo['word_count']      = self::analyze_word_count($_detail);
		$seo['content_length']  = mb_strlen(strip_tags(a($_detail, 'content')));
		$seo['text_dificould'] = self::analyze_text_dificould($_detail);

		var_dump($seo);
		var_dump($_detail);exit();
	}



	private static function analyze_title($_detail)
	{
		$score  = 0;
		$length = 0;
		$ok     = false;

		if(isset($_detail['title']) && is_string($_detail['title']))
		{
			$length = mb_strlen($_detail['title']);

			$title_rank['length'] = $length;

			if($length >= 30 && $length <= 60)
			{
				$ok = true;
				$score = 3;
			}
			elseif($length >= 60 && $length <= 90)
			{
				$ok = true;
				$score = 2;
			}
			elseif($length < 30)
			{
				$score = 1;
			}
			elseif($length > 90)
			{
				$score = 1;
			}
		}


		$title_rank =
		[
			'ok'          => $ok,
			'score'       => $score,
			'length'      => $length,
			'coefficient' => 1,
		];

		return $title_rank;

	}


	private static function analyze_word_count($_detail)
	{
		$ok    = false;
		$score = 0;
		$word_count = 0;

		if(isset($_detail['content']) && is_string($_detail['content']))
		{
			$content = strip_tags($_detail['content']);

			$word_count = str_word_count($content);
			if($content && !$word_count)
			{
				// get here: https://www.php.net/manual/en/function.str-word-count.php#107363
				$word_count = count(preg_split('~[^\p{L}\p{N}\']+~u',$content));
			}

			if($word_count >= 300)
			{
				$ok = true;
				$score = 3;
			}
			else
			{
				$score = 1;
			}
		}


		$title_rank =
		[
			'ok'          => $ok,
			'score'       => $score,
			'count'       => $word_count,
			'coefficient' => 1,
		];

		return $title_rank;
	}


	private static function analyze_sentences($_detail)
	{
		$ok    = false;
		$score = 0;
		$count = 0;

		if(isset($_detail['content']) && is_string($_detail['content']))
		{
			$content = strip_tags($_detail['content']);

			$content = strip_tags($_detail['content']);
			$content = preg_replace("/\؟/", "?", $content);
			$content = preg_replace("/\?{2,}/", "?", $content);
			$content = preg_replace("/\!{2,}/", "!", $content);
			$content = preg_replace("/\.{2,}/", ".", $content);


			$count = count(preg_split("/\?|\!|\./", $content));

		}


		$title_rank =
		[
			'ok'          => $ok,
			'score'       => $score,
			'count'       => $count,
			'coefficient' => 1,
		];

		return $title_rank;
	}




	private static function analyze_syllables($_detail)
	{
		$ok    = false;
		$score = 0;
		$count = 0;

		if(isset($_detail['content']) && is_string($_detail['content']))
		{
			$content = strip_tags($_detail['content']);

			$content = strip_tags($_detail['content']);
			$content = preg_replace("/\؟/", "?", $content);
			$content = preg_replace("/\?{2,}/", "?", $content);
			$content = preg_replace("/\!{2,}/", "!", $content);
			$content = preg_replace("/\.{2,}/", ".", $content);


			$list = preg_split("/\s/", $content);

			foreach ($list as $key => $value)
			{
				if(mb_strlen($value) < 5)
				{
					$count += 1;
				}
				elseif(mb_strlen($value) < 15)
				{
					$count += 2;
				}
				elseif(mb_strlen($value) < 20)
				{
					$count += 3;
				}
				elseif(mb_strlen($value) < 25)
				{
					$count += 4;
				}
				else
				{
					$count += 5;
				}
			}


		}


		$title_rank =
		[
			'ok'          => $ok,
			'score'       => $score,
			'count'       => $count,
			'coefficient' => 1,
		];

		return $title_rank;
	}

	private static function analyze_text_dificould($_detail)
	{
		$ok    = false;
		$score = 0;
		$note  = null;
		$level = null;

		if(isset($_detail['content']) && is_string($_detail['content']))
		{
			$content = strip_tags($_detail['content']);
			$content = preg_replace("/\؟/", "?", $content);
			$content = preg_replace("/\?{2,}/", "?", $content);
			$content = preg_replace("/!{2,}/", "!", $content);
			$content = preg_replace("/\.{2,}/", ".", $content);

			$analyze_word_count = self::analyze_word_count($_detail);
			$totla_words = $analyze_word_count['count'];

			$analyze_sentences = self::analyze_sentences($_detail);
			$total_sentences = $analyze_sentences['count'];


			$analyze_syllables = self::analyze_syllables($_detail);
			$total_syllables = $analyze_syllables['count'];


			$score = 206.835 - 1.015 * ($totla_words / $total_sentences) - 84.6 * ($total_syllables / $totla_words);


			if($score > 90)
			{
				$level = '5th grade';
				$note = T_('Very easy to read. Easily understood by an average 11-year-old student.');
			}
			elseif($score <= 90 && $score > 80)
			{
				$level = '6th grade';
				$note = T_('Easy to read.');
			}
			elseif($score <= 80 && $score > 70)
			{
				$level = '7th grade';
				$note = T_('Fairly easy to read.');
			}
			elseif($score <= 70 && $score > 60)
			{
				$level = '8th & 9th grade';
				$note = T_('Plain English. Easily understood by 13- to 15-year-old students.');
			}
			elseif($score <= 60 && $score > 50)
			{
				$level = '10th to 12th grade';
				$note = T_('Fairly difficult to read.');
			}
			elseif($score <= 50 && $score > 30)
			{
				$level = 'College';
				$note = T_('Difficult to read.');
			}
			elseif($score <= 30 && $score > 10)
			{
				$level = 'College graduate';
				$note = T_('Very difficult to read. Best understood by university graduates.');
			}
			elseif($score <= 10 && $score > 0)
			{
				$level = 'Professional';
				$note = T_('Extremely difficult to read. Best understood by university graduates.');
			}


		}


		$title_rank =
		[
			'ok'          => $ok,
			'score'       => $score,
			'level'       => $level,
			'note'       => $note,

		];

		// var_dump($title_rank);exit();

		return $title_rank;
	}


}
?>