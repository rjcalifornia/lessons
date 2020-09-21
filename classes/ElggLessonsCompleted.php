<?php
/**
 * Class for discussion reply
 *
 * We extend ElggComment to get the future thread support.
 */
class ElggLessonsCompleted extends ElggObject {

	/**
	 * Set subtype
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "lessons_completed";
	}
}
