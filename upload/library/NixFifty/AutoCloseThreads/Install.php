<?php

class NixFifty_AutoCloseThreads_Install
{
    public static function install($installedAddon)
    {
        $db = XenForo_Application::getDb();

        if (XenForo_Application::$versionId < 1030070)
        {
            throw new XenForo_Exception('This add-on requires XenForo 1.3.0 or higher.', true);
        }

        if (!$installedAddon)
        {
            foreach (self::_getAlters() AS $alterSql)
            {
                try
                {
                    $db->query($alterSql);
                }
                catch (Zend_Db_Exception $e) {}
            }
        }
        else
        {
            // upgrades
        }
    }

    public static function uninstall()
    {
        $db = XenForo_Application::getDb();

        try
        {
            $db->query("ALTER TABLE xf_forum DROP auto_close_enabled");
        }
        catch (Zend_Db_Exception $e) {}

        try
        {
            $db->query("ALTER TABLE xf_forum DROP auto_close_days");
        }
        catch (Zend_Db_Exception $e) {}

        try
        {
            $db->query("ALTER TABLE xf_forum DROP auto_close_mode");
        }
        catch (Zend_Db_Exception $e) {}

        XenForo_Db::commit($db);
    }

    protected static function _getAlters()
    {
        $alters = array();

        $alters['xf_forum_auto_close_enabled'] = "
			ALTER TABLE xf_forum	ADD COLUMN `auto_close_enabled` INT(10) UNSIGNED NOT NULL DEFAULT '0'
		";

        $alters['xf_forum_auto_close_days'] = "
			ALTER TABLE xf_forum	ADD COLUMN `auto_close_days` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '30'
		";

        $alters['xf_forum_auto_close_mode'] = "
			ALTER TABLE xf_forum	ADD COLUMN `auto_close_mode` VARCHAR(25) NOT NULL DEFAULT 'last_post_date'
		";

        return $alters;
    }

}
