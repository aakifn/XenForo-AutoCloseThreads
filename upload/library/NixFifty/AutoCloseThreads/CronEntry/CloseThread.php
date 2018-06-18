<?php

class NixFifty_AutoCloseThreads_CronEntry_CloseThread
{
    public static function run()
    {
        /** @var NixFifty_AutoCloseThreads_Model_AutoClose $autoCloseModel */
        $autoCloseModel = XenForo_Model::create('NixFifty_AutoCloseThreads_Model_AutoClose');

        $closeForums = $autoCloseModel->getAutoCloseForums();

        if (!empty($closeForums))
        {
            $threadsToClose = array();

            foreach ($closeForums AS $forumId => $forum)
            {
                $threadsToClose = array_merge($threadsToClose,
                    $autoCloseModel->getThreadsToClose($forum));
            }

            if (!empty($threadsToClose))
            {
                foreach ($threadsToClose AS $thread)
                {
                    /** @var XenForo_DataWriter_Discussion_Thread $threadDw */
                    $threadDw = XenForo_DataWriter::create('XenForo_DataWriter_Discussion_Thread');
                    $threadDw->setExistingData($thread);
                    $threadDw->set('discussion_open', 0);
                    $threadDw->save();

                    $autoCloseModel->logThreadClose($thread['thread_id']);
                }
            }
        }

        return true;
    }
}