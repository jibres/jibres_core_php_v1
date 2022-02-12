ALTER TABLE jibres_api_log.sms ADD `deliverstatus`  ENUM('delivered','undelivered','block', 'other', 'failed', 'cancel') CHARACTER SET utf8mb4  NULL DEFAULT NULL AFTER `status`;

