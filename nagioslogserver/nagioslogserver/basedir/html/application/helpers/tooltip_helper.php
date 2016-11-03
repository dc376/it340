<?php
	/**
	 * Shortcut to show a question mark icon with a tooltip
	 **/

	 function question_tooltip($text) {
	 	return ' <i class="fa fa-question-circle ls-tooltip" title="'.htmlentities($text, ENT_COMPAT, 'UTF-8').'"></i>';
	 }