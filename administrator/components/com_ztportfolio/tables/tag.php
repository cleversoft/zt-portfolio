<?php

/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2015 ZooTemplate. All rights reserved.
 * * @license     GNU GPL v2.
 */
defined('_JEXEC') or die();

class ZtPortfolioTableTag extends FOFTable {

    public function check() {

        $result = true;

        //Alias
        if (empty($this->alias)) {
            $this->alias = JFilterOutput::stringURLSafe($this->title);
        } else {
            $this->alias = JFilterOutput::stringURLSafe($this->alias);
        }

        $existingAlias = FOFModel::getTmpInstance('Tags', 'ZtPortfolioModel')
                ->alias($this->alias)
                ->getList(true);

        if (!empty($existingAlias)) {
            $count = 0;
            $k = $this->getKeyName();
            foreach ($existingAlias as $item) {
                if ($item->$k != $this->$k)
                    $count++;
            }
            if ($count) {
                $this->setError(JText::_('COM_ZTPORTFOLIO_ALIAS_ERR_SLUGUNIQUE'));
                $result = false;
            }
        }

        return $result;
    }

}
