<?php
/**
* Joomlaquiz Deluxe Component for Joomla 3
* @package Joomlaquiz Deluxe
* @author JoomPlace Team
* @copyright Copyright (C) JoomPlace, www.joomplace.com
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

/**
 * Joomlaquiz Deluxe class
 */
class JoomlaquizViewReviewHotspot
{
	public static function getReviewContent($review_data, $data){
		
		$tag = JFactory::getLanguage()->getTag();
		$lang = JFactory::getLanguage();
		$lang->load('com_joomlaquiz', JPATH_SITE, $tag, true);
		
		$path_str = '';
		if(!empty($review_data['c_paths'])){
			foreach($review_data['c_paths'] as $path){
				$path_str .= '<path style="fill-opacity: 0.5;" fill="#147edb" stroke="#ffffff" d="'.$path.'" stroke-width="3" fill-opacity="0.5"/>'."\n";
			}
		}
		
		$jq_tmpl_html = '
			<center>
			<div id="foo_'.$review_data['quest_id'].'" style="margin-top:15px;">
				<svg height="'.$review_data['height'].'" version="1.1" width="'.$review_data['width'].'" xmlns="http://www.w3.org/2000/svg">
				<image x="0" y="0" width="'.$review_data['width'].'" height="'.$review_data['height'].'" preserveAspectRatio="none" xlink:href="'.JURI::root().'images/joomlaquiz/images/'.$review_data['c_image'].'"/>
				'.$path_str.'
				<circle data-scale="initial" cx="'.$review_data['c_select_x'].'" cy="'.$review_data['c_select_y'].'" r="5" fill="#ffa500" stroke="#ff0000" style=""/>
				</svg>
			</div>';
		
		$jq_tmpl_html .= '
				<table>
				<tr>
					<td class="review_statistic">'.JText::_('COM_QUIZ_RST_PPAST').' '.$review_data['past_this'].' '.JText::_('COM_QUIZ_RST_PPAST_TIMES').', '.$review_data['rht_proc'].'% '.JText::_('COM_QUIZ_RST_ARIGHT').'</td>
				</tr>
				</table>
			</center>';
		return $jq_tmpl_html;
	}
}

?>