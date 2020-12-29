ALTER TABLE jibres.posts ADD `redirecturl` text CHARACTER SET utf8mb4 NULL;
ALTER TABLE jibres.posts ADD `specialaddress` enum('independence', 'special', 'under_tag', 'under_page')  NULL;