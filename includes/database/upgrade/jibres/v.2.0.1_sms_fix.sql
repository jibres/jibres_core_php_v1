ALTER TABLE jibres.sms_log CHANGE `mode` `mode` ENUM('sms','call','tts', 'verification', 'receive', 'lookup') CHARACTER SET utf8mb4  NULL DEFAULT NULL;
ALTER TABLE jibres_api_log.sms CHANGE `mode` `mode` ENUM('sms','call','tts', 'verification', 'receive', 'lookup') CHARACTER SET utf8mb4  NULL DEFAULT NULL;

