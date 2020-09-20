UPDATE
	jibres_XXXXXXX.form_answerdetail
	SET
		jibres_XXXXXXX.form_answerdetail.choice_id =
		(
			SELECT
				jibres_XXXXXXX.form_choice.id
			FROM
				jibres_XXXXXXX.form_choice
			WHERE
				jibres_XXXXXXX.form_choice.form_id = jibres_XXXXXXX.form_answerdetail.form_id AND
				jibres_XXXXXXX.form_choice.item_id = jibres_XXXXXXX.form_answerdetail.item_id AND
				jibres_XXXXXXX.form_choice.status  = 'enable' AND
				jibres_XXXXXXX.form_choice.title   = jibres_XXXXXXX.form_answerdetail.answer
			LIMIT 1
		)
	WHERE 1;