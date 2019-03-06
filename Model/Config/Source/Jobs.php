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

class Jobs extends AbstractOptions implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Get cronjobs as option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $disabledGroups = explode(
            ",",
            $this->_scopeConfig->getValue(
                'system/cronjob_disabler/jobs',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            )
        );

        $groups = $this->getJobs();
        $options[] = ['value' => '', 'label' => __('--Please Select--')];
        foreach ($groups as $groupName => $jobs) {
            if (!in_array('group_' . $groupName, $disabledGroups)) {
                $options[] = [
                    'value' => 'group_' . $groupName,
                    'label' => __('group: %1', $groupName)
                ];
                foreach ($jobs as $jobName => $job) {
                    $jobSchedule = (isset($job['schedule'])) ? ' [' . $job['schedule'] . ']' : '';
                    $options[] = [
                        'value' => $jobName,
                        'label' => '-- ' . $jobName . $jobSchedule
                    ];
                }
            } else {
                $options[] = [
                    'value' => 'group_' . $groupName,
                    'label' => __('group: %1 (completely disabled)', $groupName)
                ];
            }
        }
        return $options;
    }
}
