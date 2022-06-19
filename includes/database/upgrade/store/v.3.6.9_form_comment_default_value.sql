UPDATE jibres_XXXXXXX.form_comment SET  form_comment.date = form_comment.datecreated WHERE form_comment.date IS NULL;
UPDATE jibres_XXXXXXX.form_answer SET  form_answer.status = 'active' WHERE form_answer.status IS NULL;
