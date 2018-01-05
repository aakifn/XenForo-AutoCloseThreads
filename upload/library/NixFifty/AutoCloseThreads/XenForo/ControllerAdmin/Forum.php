<?php

class NixFifty_AutoCloseThreads_XenForo_ControllerAdmin_Forum extends XFCP_NixFifty_AutoCloseThreads_XenForo_ControllerAdmin_Forum
{
	public function actionEdit()
	{
		/*$response = parent::actionEdit();

		if ($response instanceof XenForo_ControllerResponse_View && $response->params &&
			!isset($response->params['forum']['auto_close_mode']))
		{
			$response->params['forum']['auto_close_mode'] = 'last_post_date';
		}
		die(Zend_Debug::dump($response->params));*/
		return parent::actionEdit();
	}

	public function actionSave()
    {
        $writerData = $this->_input->filter(array(
            'auto_close_enabled' => XenForo_Input::BOOLEAN,
            'auto_close_days' => XenForo_Input::UINT,
            'auto_close_mode' => XenForo_Input::STRING
        ));

        NixFifty_AutoCloseThreads_Globals::$enabled = $writerData['auto_close_enabled'];
        NixFifty_AutoCloseThreads_Globals::$days = $writerData['auto_close_days'];
        NixFifty_AutoCloseThreads_Globals::$mode = $writerData['auto_close_mode'];

        return parent::actionSave();
    }
}