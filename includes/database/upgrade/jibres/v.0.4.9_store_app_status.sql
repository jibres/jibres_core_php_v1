ALTER TABLE jibres.store_app CHANGE `status` `status` ENUM('queue','inprogress','done','failed','disable','expire','cancel','delete','enable','info','error') CHARACTER SET utf8mb4 NULL DEFAULT NULL;
