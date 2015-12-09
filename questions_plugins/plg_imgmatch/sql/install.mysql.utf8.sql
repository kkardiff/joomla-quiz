DELETE FROM `#__quiz_t_qtypes` WHERE c_id = '12';
INSERT INTO #__quiz_t_qtypes (c_id, c_qtype, c_type) VALUES (12, 'Image Match', 'imgmatch');

CREATE TABLE IF NOT EXISTS `#__quiz_t_matching` (
			`c_id` int(10) unsigned NOT NULL auto_increment,
			`c_question_id` int(10) unsigned NOT NULL default '0',
			`c_left_text` text NOT NULL,
			`c_right_text` text NOT NULL,
			`ordering` int(11) NOT NULL default '0',
			`c_quiz_id` int(11) NOT NULL default '0',
			`a_points` FLOAT( 11 ) NOT NULL default '0',
			PRIMARY KEY  (`c_id`),
			KEY `c_question_id` (`c_question_id`) ) DEFAULT CHARSET=utf8;
			
CREATE TABLE IF NOT EXISTS `#__quiz_r_student_matching` (
			`c_id` int(10) unsigned NOT NULL auto_increment,
			`c_sq_id` int(10) unsigned NOT NULL default '0',
			`c_sel_text` text NOT NULL,
			`c_matching_id` int(10) unsigned NOT NULL default '0',
			PRIMARY KEY  (`c_id`),
			KEY `c_sq_id` (`c_sq_id`),
			KEY `c_matching_id` (`c_matching_id`) ) DEFAULT CHARSET=utf8;
			
ALTER TABLE `#__quiz_r_student_question` ADD `c_elapsed_time` INT( 10 ) NOT NULL;
ALTER TABLE `#__quiz_t_question` ADD `c_width` INT( 10 ) NOT NULL DEFAULT '150';
ALTER TABLE `#__quiz_t_question` ADD `c_timer` INT( 10 ) NOT NULL;
ALTER TABLE `#__quiz_t_question` ADD `c_height` INT( 10 ) NOT NULL DEFAULT '150';