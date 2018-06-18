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

    public function getThreadsToClose($forum)
    {
        $input = array($forum['node_id']);

        if ($forum['auto_close_replies'] != -1)
        {
            $input[] = $forum['auto_close_replies'];
        }

        if ($forum['auto_close_views'] != -1)
        {
            $input[] = $forum['auto_close_views'];
        }

        return $this->_getDb()->fetchAll('
			SELECT thread.*
			FROM xf_thread AS thread
			WHERE discussion_open = 1
			    AND sticky = 0
			    AND node_id = ?'
                . ($forum['auto_close_replies'] != -1 ? 'AND reply_count <= ?' : '').
                . ($forum['auto_close_views'] != -1 ? 'AND view_count <= ?' : '').
                'AND '. ($forum['auto_close_mode'] == 'last_post_date' ? 'last_post_date' : 'post_date') . ' <= ' . intval(time() - (60 * 60 * 24 * $forum['auto_close_days'])) .'
		', $input);
    }

    public function logThreadClose($threadId)
    {
	    $this->_getDb()->query('
			INSERT ' . (XenForo_Application::get('options')->enableInsertDelayed ? 'DELAYED' : '') . ' INTO xf_nf_auto_closed
				(thread_id)
			VALUES
				(?)
		', $threadId);
    }

    public function deleteThreadClose($threadId)
    {
    	$this->_getDb()->query('
    	    DELETE IGNORE FROM xf_nf_auto_closed
    	    WHERE thread_id = ?
        ', $threadId);
    }
}