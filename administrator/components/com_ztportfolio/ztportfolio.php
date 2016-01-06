<?php

/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2015 ZooTemplate. All rights reserved.
 * * @license     GNU GPL v2.
 */
defined('_JEXEC') or die();

// Load FOF
include_once JPATH_LIBRARIES . '/fof/include.php';
if (!defined('FOF_INCLUDED')) {
    JError::raiseError('500', 'FOF is not installed');

    return;
}

FOFDispatcher::getTmpInstance('com_ztportfolio')->dispatch();
