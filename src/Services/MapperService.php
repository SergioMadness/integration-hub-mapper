<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Mapper\Services;

use Exception;
use Illuminate\Support\Arr;
use professionalweb\IntegrationHub\Mapper\Models\MapperOptions;
use professionalweb\IntegrationHub\Mapper\Interfaces\MapperSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;

/**
 * Service to translate values
 */
class MapperService implements MapperSubsystem
{
    private ProcessOptions $processOptions;

    /**
     * Get available options
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new MapperOptions();
    }

    /**
     * Process event data
     *
     * @throws Exception
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
                throw new Exception('Wrong map');
            }
            foreach ($values as $oldVal => $newVal) {
                if (Arr::get($data, $field) == $oldVal) {
                    Arr::set($data, $field, $newVal);
                }
            }
        }

        return $eventData->setData($data);
    }

    public function getProcessOptions(): ProcessOptions
    {
        return $this->processOptions;
    }

    /**
     * Set options with values
     */
    public function setProcessOptions(ProcessOptions $options): Subsystem
    {
        $this->processOptions = $options;

        return $this;
    }
}