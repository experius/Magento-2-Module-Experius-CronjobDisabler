<?php


namespace Experius\CronjobDisabler\Model\Config\Source;

class Jobs extends AbstractOptions implements \Magento\Framework\Option\ArrayInterface
{

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
        $options[] = ['value'=>'','label'=> __('--Please Select--') ];
        foreach ($groups as $groupName => $jobs) {
            $options[] = ['value'=>'group_' . $groupName,'label'=> 'group ' . $groupName];
            if (!in_array('group_' . $groupName, $disabledGroups)) {
                foreach ($jobs as $jobName => $job) {
                    $options[] = ['value'=>$jobName,'label'=> '-- ' . $jobName];
                }
            } else {
                $options[] = ['value'=>'','label'=> '-- whole group is disabled'];
            }
        }
        return $options;
    }
}
