<?php

class NixFifty_AutoCloseThreads_XenForo_ControllerAdmin_Forum extends XFCP_NixFifty_AutoCloseThreads_XenForo_ControllerAdmin_Forum
{
	public function actionSave()
    {
        $writerData = $this->_input->filter(array(
            'auto_close_enabled' => XenForo_Input::BOOLEAN,
            'auto_close_days' => XenForo_Input::UINT,
            'auto_close_mode' => XenForo_Input::STRING,
            'auto_close_replies' => XenForo_Input::INT,
            'auto_close_views' => XenForo_Input::INT,
        ));

        NixFifty_AutoCloseThreads_Globals::$enabled = $writerData['auto_close_enabled'];
        NixFifty_AutoCloseThreads_Globals::$days = $writerData['auto_close_days'];
        NixFifty_AutoCloseThreads_Globals::$mode = $writerData['auto_close_mode'];
        NixFifty_AutoCloseThreads_Globals::$replies = $writerData['auto_close_replies'];
        NixFifty_AutoCloseThreads_Globals::$views = $writerData['auto_close_views'];
        return parent::actionSave();
    }
}