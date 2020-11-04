ALTER TABLE jibres.users ADD `ban_expire` datetime NULL DEFAULT NULL;
ALTER TABLE jibres.users CHANGE `status` `status` ENUM('active','awaiting','deactive','removed','filter','unreachable','ban','block') CHARACTER SET utf8mb4  NULL DEFAULT 'awaiting';
