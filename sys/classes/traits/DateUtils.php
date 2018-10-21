<?php

/**
 * Помоћне функције за рад са датумом
 */
trait DateUtils {

	/**
	 * Форматирање датума и времена
	 * @param int|string PHP или MySQL временски печат
	 * @return string
	 */
	final public static function formatDateAndTime($ts) {
		if (is_string($ts)) {
			$ts = strtotime($ts);
		}
		return date('H:i:s d.m.Y', $ts);
	}

}
