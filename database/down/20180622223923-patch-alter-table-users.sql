ALTER TABLE users DROP FOREIGN KEY fk_users_working_store;
DROP INDEX idx_users_working_store ON users;
ALTER TABLE users DROP working_store_id;