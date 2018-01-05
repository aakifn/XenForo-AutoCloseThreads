<?php

class NixFifty_AutoCloseThreads_Listen
{
	public static function loadClass($class, array &$extend)
	{
		$extend[] = 'NixFifty_AutoCloseThreads_' . $class;
	}
}