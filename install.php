<?php
/**
 * @package    Jmb_Donation
 * @author     Dmitry Rekun <support@norrnext.com>
 * @copyright  Copyright (C) 2011 - 2015 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;

/**
 * Install script class
 *
 * @since  1.0
 */
class PlgContentJmb_DonationInstallerScript
{
	/**
	 * Method to set message after installation
	 *
	 * @param   string            $route    The type of the route: install, uninstall, discover_install, update
	 * @param   JAdapterInstance  $adapter  The class who calls this method
	 *
	 * @return  boolean
	 *
	 * @since   1.0
	 */
	public function postflight($route, JAdapterInstance $adapter)
	{
		if ($route == 'install')
		{
			$manifest = $adapter->getParent()->get('manifest');

			$name = strtolower($adapter->get('name'));
			$type = (string) $manifest->attributes()->type;

			try
			{
				$db = $adapter->getParent()->getDbo();

				$query = $db->getQuery(true)
					->select($db->quoteName('extension_id'))
					->from($db->quoteName('#__extensions'))
					->where($db->quoteName('type') . ' = ' . $db->quote($type))
					->where($db->quoteName('name') . ' = ' . $db->quote($name));
				$db->setQuery($query);

				$id = $db->loadResult();
			}
			catch (RuntimeException $e)
			{
				return false;
			}

			echo JText::sprintf('PLG_CONTENT_JMB_DONATION_INSTALL_TEXT', $id);
		}

		return true;
	}
}
