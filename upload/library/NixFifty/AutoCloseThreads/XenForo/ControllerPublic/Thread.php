<?php

class NixFifty_AutoCloseThreads_XenForo_ControllerPublic_Thread
	extends XFCP_NixFifty_AutoCloseThreads_XenForo_ControllerPublic_Thread
{
	protected function _getThreadForumFetchOptions()
	{
		list($threadFetchOptions, $forumFetchOptions) = parent::_getThreadForumFetchOptions();

		$threadFetchOptions['nfAutoClose'] = true;

		return [$threadFetchOptions, $forumFetchOptions];
	}
}