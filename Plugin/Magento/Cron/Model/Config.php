<?php


namespace Experius\CronjobDisabler\Plugin\Magento\Cron\Model;

class Config
{
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function afterGetJobs(
        \Magento\Cron\Model\Config $subject,
        $result
    ) {

        $disabledGroups = explode(
            ",",
            $this->scopeConfig->getValue(
                'system/cronjob_disabler/jobs',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            )
        );

        $filteredCronjobs = [];
        foreach ($result as $groupName => $jobs) {
            $options[] = ['value'=>'group_' . $groupName,'label'=> 'group ' . $groupName];

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
