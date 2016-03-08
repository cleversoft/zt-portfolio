<?php

/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2015 ZooTemplate. All rights reserved.
 * * @license     GNU GPL v2.
 */
defined('_JEXEC') or die();

class ZtPortfolioModelItems extends FOFModel {

    public function __construct($config = array()) {
        parent::__construct($config);
    }

    public function buildQuery($overrideLimits = false) {

        return parent::buildQuery();
    }

}
