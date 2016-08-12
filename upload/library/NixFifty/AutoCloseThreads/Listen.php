<?php

class NixFifty_AutoCloseThreads_Listen
{
    public static function loadForumController($class, array &$extend)
    {
        $extend[] = 'NixFifty_AutoCloseThreads_XenForo_ControllerAdmin_Forum';
    }

    public static function loadForumDataWriter($class, array &$extend)
    {
        $extend[] = 'NixFifty_AutoCloseThreads_XenForo_DataWriter_Forum';
    }
}