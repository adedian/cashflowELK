-- Hak akses pengguna DB aplikasi (ganti 'GANTI_PASSWORD'). Jalankan sebagai root setelah schema.sql.
-- audit_logs hanya SELECT+INSERT agar jejak audit tidak dapat diubah/dihapus oleh aplikasi.
CREATE USER IF NOT EXISTS 'cashflow_elk_app'@'localhost' IDENTIFIED BY 'GANTI_PASSWORD';
CREATE USER IF NOT EXISTS 'cashflow_elk_app'@'127.0.0.1' IDENTIFIED BY 'GANTI_PASSWORD';
-- ulangi blok berikut untuk host 'localhost' dan '127.0.0.1'
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.users TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.login_attempts TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.accounts TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.categories TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.projects TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.category_map TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.counterparty_accounts TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.import_batches TO 'cashflow_elk_app'@'127.0.0.1';
-- Revisi 2: Hutang & Impor Excel berpemetaan
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.debts TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.debt_payments TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.import_templates TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.transactions TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.invoices TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.forecast_items TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.note_categories TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.notes TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.data_versions TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.app_settings TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT ON cashflow_elk.audit_logs TO 'cashflow_elk_app'@'127.0.0.1';
-- Revisi 3: integrasi Transaksi <-> Hutang/Piutang/Proyeksi + master Supplier
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.suppliers TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.invoice_payments TO 'cashflow_elk_app'@'127.0.0.1';
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.forecast_realizations TO 'cashflow_elk_app'@'127.0.0.1';
-- Revisi 3b: master Pihak
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.parties TO 'cashflow_elk_app'@'127.0.0.1';
-- Revisi 11: kategori & proyek per baris uraian
GRANT SELECT, INSERT, UPDATE, DELETE ON cashflow_elk.transaction_items TO 'cashflow_elk_app'@'127.0.0.1';
GRANT LOCK TABLES ON cashflow_elk.* TO 'cashflow_elk_app'@'127.0.0.1';
FLUSH PRIVILEGES;
