<?php

class NixFifty_AutoCloseThreads_XenForo_DataWriter_Discussion_Thread
	extends XFCP_NixFifty_AutoCloseThreads_XenForo_DataWriter_Discussion_Thread
{
	protected function _discussionPostSave()
	{
		if ($this->isUpdate() && !$this->getExisting('discussion_open')
			&& $this->get('discussion_open')
		)
		{
			/** @var NixFifty_AutoCloseThreads_Model_AutoClose $autoCloseModel */
			$autoCloseModel = $this->getModelFromCache('NixFifty_AutoCloseThreads_Model_AutoClose');
			$autoCloseModel->deleteThreadClose($this->get('thread_id'));
		}
	}
}