<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Mapper\Models;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;

/**
 * Subsystem options
 */
class MapperOptions implements SubsystemOptions
{

    /**
     * Get available fields for mapping
     */
    public function getAvailableFields(): array
    {
        return [];
    }

    /**
     * Get array fields, that subsystem generates
     */
    public function getAvailableOutFields(): array
    {
        return [];
    }

    /**
     * Get service settings
     */
    public function getOptions(): array
    {
        return [
            'map' => [
                'name' => 'Map',
                'type' => 'list',
            ],
        ];
    }
}