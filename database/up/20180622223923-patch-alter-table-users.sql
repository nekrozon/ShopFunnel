ALTER TABLE users ADD working_store_id INT DEFAULT NULL;
ALTER TABLE users ADD CONSTRAINT fk_users_working_store FOREIGN KEY (working_store_id) REFERENCES stores (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
CREATE INDEX idx_users_working_store ON users (working_store_id);