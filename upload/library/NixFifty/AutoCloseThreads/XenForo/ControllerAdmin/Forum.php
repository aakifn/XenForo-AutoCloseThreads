<?php

class NixFifty_AutoCloseThreads_XenForo_ControllerAdmin_Forum extends XFCP_NixFifty_AutoCloseThreads_XenForo_ControllerAdmin_Forum
{
    public function actionSave()
    {
        $response = parent::actionSave();

        $nodeId = $this->_input->filterSingle('node_id', XenForo_Input::UINT);

        $writerData = $this->_input->filter(array(
            'auto_close_enabled' => XenForo_Input::UINT,
            'auto_close_days' => XenForo_Input::UINT,
            'auto_close_mode' => XenForo_Input::STRING
        ));

        $writer = $this->_getNodeDataWriter();
        $writer->setExistingData($nodeId);
        $writer->bulkSet($writerData);
        $writer->save();

        return $response;
    }
}