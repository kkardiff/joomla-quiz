ALTER TABLE `#__quiz_r_student_question` ADD COLUMN `respond_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `c_flag_question`;