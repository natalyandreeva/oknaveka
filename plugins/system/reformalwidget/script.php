<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
  
class plgSystemReformalwidgetInstallerScript
{
    function preflight($route, $adapter) {}
     
    function install($adapter) {}
 
    function update($adapter) {}
 
    function uninstall($adapter) {}
 
    function postflight($route, $adapter)
    {
        if (stripos($route, 'install') !== false || stripos($route, 'update') !== false)
        {
            return $this->renameManifest($adapter);
        }
    }
     
    private function renameManifest($adapter)
    {
        $filesource = $adapter->get('parent')->getPath('extension_root').'/_reformalwidget.xml';
        $filedest = $adapter->get('parent')->getPath('extension_root').'/reformalwidget.xml';
         
        if (!(JFile::move($filesource, $filedest)))
        {
            JLog::add(JText::sprintf('JLIB_INSTALLER_ERROR_FAIL_COPY_FILE', $filesource, $filedest), JLog::WARNING, 'jerror');
             
            if (class_exists('JError'))
            {
                JError::raiseWarning(1, 'JInstaller::install: '.JText::sprintf('Failed to copy file to', $filesource, $filedest));
            }
            else
            {
                throw new Exception('JInstaller::install: '.JText::sprintf('Failed to copy file to', $filesource, $filedest));
            }
            return false;
        }
         
        return true;
    }
}