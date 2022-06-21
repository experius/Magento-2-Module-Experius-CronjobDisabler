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

namespace Experius\CronjobDisabler\Plugin\Magento\Cron\Model;

class Config
{
    protected $scopeConfig;

    /**
     * Config constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * After get jobs plugin
     *
     * @param \Magento\Cron\Model\Config $subject
     * @param $result
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @SuppressWarnings(PHPMD.UnusedLocalVariable) $job in foreach
     */
    public function afterGetJobs(
        \Magento\Cron\Model\Config $subject,
        $result
    )
    {
        $disabledGroups = explode(
            ",",
            $this->scopeConfig->getValue(
                'system/cronjob_disabler/jobs',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            )
        );

        $filteredCronjobs = [];
        foreach ($result as $groupName => $jobs) {
            if (!in_array('group_' . $groupName, $disabledGroups)) {
                foreach ($jobs as $jobName => $job) {
                    if (in_array($groupName . '_' . $jobName, $disabledGroups)) {
                        unset($jobs[$jobName]);
                    }
                }

                $filteredCronjobs[$groupName] = $jobs;
            }
        }

        return $filteredCronjobs;
    }
}
