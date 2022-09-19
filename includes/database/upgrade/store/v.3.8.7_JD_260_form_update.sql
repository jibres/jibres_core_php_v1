
UPDATE
	jibres_XXXXXXX.form_answer
SET form_answer.amount =
		(SELECT transactions.plus FROM jibres_XXXXXXX.transactions WHERE transactions.id = form_answer.transaction_id)
WHERE form_answer.transaction_id IS NOT NULL;

UPDATE
	jibres_XXXXXXX.form_answer
SET form_answer.payed =
		(SELECT transactions.verify FROM jibres_XXXXXXX.transactions WHERE transactions.id = form_answer.transaction_id)
WHERE form_answer.transaction_id IS NOT NULL;

