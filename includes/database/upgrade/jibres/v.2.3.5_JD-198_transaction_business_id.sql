ALTER TABLE jibres.transactions ADD `store_id` int unsigned NULL DEFAULT NULL;

ALTER TABLE jibres.transactions
    ADD CONSTRAINT `transaction_store_id`
        FOREIGN KEY (`store_id`)
            REFERENCES `store` (`id`)
            ON UPDATE CASCADE;