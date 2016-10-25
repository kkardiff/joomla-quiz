<?php
/**
* JoomlaQuiz module for Joomla
* @version $Id: helper.php 2011-03-03 17:30:15
* @package JoomlaQuiz
* @subpackage helper.php
* @author JoomPlace Team
* @Copyright Copyright (C) JoomPlace, www.joomplace.com
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined('_JEXEC') or die;

class modTopxusersHelper
{
	/*
	 * @since  1.5
	 */
	public static function getResult(&$params)
	{
		$db = JFactory::getDBO();
		$my = JFactory::getUser();
		
		$result = array();
		$v_content_count 	= intval( $params->get( 'quiz_count', 10 ) );
		$quiz_id		 	= trim( $params->get( 'quizid' ) );
		$m_user_display     = intval( $params->get( 'user_display', 0 ) );
		
		if ($v_content_count == 0) {
			$v_content_count = 5;
		}

		$query = $db->getQuery(true);
		$query->select(array('qrsq.c_id, qtq.c_title, qrsq.c_total_score, u.name, u.username as alt_username, qrsq.user_name as username, u.id'));
		$query->from($db->qn('#__quiz_r_student_quiz', 'qrsq'));
		if ($quiz_id) {
			$quiz_ids = explode( ',', $quiz_id );
			if(count($quiz_ids)){
				$query->join('LEFT', $db->qn('#__quiz_t_quiz', 'qtq') . ' ON (' . $db->qn('qtq.c_id') . ' = ' . $db->qn('qrsq.c_quiz_id') . ') AND ( qtq.c_id=' . implode( ' OR qtq.c_id=', $quiz_ids ) . ' )');

				foreach ($quiz_ids as $key => $value) {
					$quiz_ids[$key] = $db->q($value);
				}

				$query->where($db->qn('qtq.c_id') . ' IN (' . implode(',',$quiz_ids).')');
			}
		}
		else {
			$query->join('LEFT', $db->qn('#__quiz_t_quiz', 'qtq') . ' ON (' . $db->qn('qtq.c_id') . ' = ' . $db->qn('qrsq.c_quiz_id') . ')');
		}

		$query->join('LEFT', $db->qn('#__users', 'u') . ' ON (' . $db->qn('u.id') . ' = ' . $db->qn('qrsq.c_student_id') . ')');
		$query->where($db->qn('qrsq.c_passed') . ' =  1', 'AND');
		$query->where($db->qn('qrsq.user_name') . ' !=  ""');
		$query->order($db->qn('qrsq.c_total_score') . ' DESC');
		$query->order($db->qn('qrsq.c_id') . ' DESC');

		$db->SetQuery($query, 0, $v_content_count);
		$result = $db->LoadObjectList();

		if (!$m_user_display) {
			foreach ($result as $i => $user) {
				$result[$i]->username = $result[$i]->username ? $result[$i]->username : $result[$i]->alt_username;
			}
		}

		if (count($result) == 0) {
			$result = array(); 
		}
		return $result;
	}
}
