UPDATE jibres_XXXXXXX.sms_log SET sms_log.status = 'expired' WHERE sms_log.status IN('pending', 'register') AND sms_log.jibres_sms_id IS NULL AND sms_log.datecreated < '2022-09-07 16:00:00' ;
