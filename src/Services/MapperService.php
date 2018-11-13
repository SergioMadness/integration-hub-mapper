<?php namespace professionalweb\IntegrationHub\Mapper\Services;

use Illuminate\Support\Arr;
use professionalweb\IntegrationHub\Mapper\Models\MapperOptions;
use professionalweb\IntegrationHub\Mapper\Interfaces\MapperSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;

/**
 * Service to translate values
 * @package professionalweb\IntegrationHub\Mapper\Services
 */
class MapperService implements MapperSubsystem
{
    /**
     * @var ProcessOptions
     */
    private $processOptions;

    /**
     * Set options with values
     *
     * @param ProcessOptions $options
     *
     * @return Subsystem
     */
    public function setProcessOptions(ProcessOptions $options): Subsystem
    {
        $this->processOptions = $options;

        return $this;
    }

    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new MapperOptions();
    }

    /**
     * Process event data
     *
     * @param EventData $eventData
     *
     * @return EventData
     * @throws \Exception
     */
    public function process(EventData $eventData): EventData
    {
        $map = $this->getProcessOptions()->getOptions()['map'] ?? [];
        if (empty($map)) {
            return $eventData;
        }
        $data = $eventData->getData();
        foreach ($map as $field => $values) {
            if (!is_array($values)) {
                throw new \Exception('Wrong map');
            }
            foreach ($values as $oldVal => $newVal) {
                if (Arr::get($data, $field) === $oldVal) {
                    Arr::set($data, $field, $newVal);
                }
            }
        }

        return $eventData->setData($data);
    }

    /**
     * @return ProcessOptions
     */
    public function getProcessOptions(): ProcessOptions
    {
        return $this->processOptions;
    }
}