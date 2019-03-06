<?php
/**
 * A Magento 2 module named Experius/CronjobDisabler
 * Copyright (C) 2019 Experius
 *
 * This file is part of Experius/CronjobDisabler.
 *
 * Experius/CronjobDisabler is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Experius\CronjobDisabler\Model\Config\Source;

class AbstractOptions
{
    /**
     * Cron config data
     *
     * @var \Magento\Cron\Model\Config\Data
     */
    protected $_configData;

    /**
     * Scope config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * Initialize needed parameters
     *
     * @param \Magento\Cron\Model\Config\Data $configData
     */
    public function __construct(
        \Magento\Cron\Model\Config\Data $configData,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->_configData = $configData;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * Return cron full cron jobs
     *
     * @return array
     */
    public function getJobs()
    {
        return $this->_configData->getJobs();
    }
}
