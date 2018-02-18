<?php


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
    ) {
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
