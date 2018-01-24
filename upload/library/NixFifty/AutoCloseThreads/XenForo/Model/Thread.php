<?php

class NixFifty_AutoCloseThreads_XenForo_Model_Thread
	extends XFCP_NixFifty_AutoCloseThreads_XenForo_Model_Thread
{
	public function prepareThreadFetchOptions(array $fetchOptions)
	{
		$joinOptions = parent::prepareThreadFetchOptions($fetchOptions);
		$selectFields = $joinOptions['selectFields'];
		$joinTables = $joinOptions['joinTables'];
		$orderClause = $joinOptions['orderClause'];

		if (!empty($fetchOptions['nfAutoClose']))
		{
			$selectFields .= ", (
                SELECT COUNT(auto_closed.thread_id) 
                FROM xf_nf_auto_closed as auto_closed
                WHERE auto_closed.thread_id = thread.thread_id) AS nf_auto_close
            ";
		}

		return [
			'selectFields' => $selectFields,
			'joinTables' => $joinTables,
			'orderClause' => $orderClause
		];
	}
}