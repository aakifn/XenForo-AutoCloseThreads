<?php

class NixFifty_AutoCloseThreads_XenForo_DataWriter_Forum extends XFCP_NixFifty_AutoCloseThreads_XenForo_DataWriter_Forum
{
    /**
     * Gets the fields that are defined for the table. See parent for explanation.
     *
     * @return array
     */
    protected function _getFields()
    {
        $fields = parent::_getFields();

        $fields['xf_forum']['auto_close_enabled'] = array('type' => self::TYPE_BOOLEAN, 'default' => 0);
        $fields['xf_forum']['auto_close_days'] = array('type' => self::TYPE_UINT, 'default' => 0);
        $fields['xf_forum']['auto_close_mode'] = array('type' => self::TYPE_STRING, 'default' => 'last_post_date',
            'allowedValues' => array('post_date', 'last_post_date')
        );

        return $fields;
    }
}