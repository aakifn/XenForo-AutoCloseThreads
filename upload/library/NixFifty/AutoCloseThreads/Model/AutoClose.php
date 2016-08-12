<?php

class NixFifty_AutoCloseThreads_Model_AutoClose extends XenForo_Model
{
    public function getAutoCloseForums()
    {
        return $this->fetchAllKeyed('
			SELECT forum.*
			FROM xf_forum AS forum
			WHERE forum.auto_close_enabled = 1
		', 'node_id');
    }

    public function getThreadsToClose($nodeId, $days = 30, $mode = 'last_post_date')
    {
        return $this->_getDb()->fetchAll('
			SELECT thread.*
			FROM xf_thread AS thread
			WHERE discussion_open = 1 
			    AND sticky = 0
			    AND node_id = ?
                AND '. ($mode == 'last_post_date' ? 'last_post_date' : 'post_date') . ' <= ' . intval(time() - (60 * 60 * 24 * $days)) .'
		', array($nodeId));
    }
}