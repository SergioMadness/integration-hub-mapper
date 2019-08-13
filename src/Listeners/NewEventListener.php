<?php namespace professionalweb\IntegrationHub\Mapper\Listeners;

use professionalweb\IntegrationHub\Mapper\Interfaces\MapperSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Events\EventToProcess;

class NewEventListener
{
    public function handle(EventToProcess $eventToProcess)
    {
        return $eventToProcess->getProcessOptions()->getSubsystemId() === MapperSubsystem::SUBSYSTEM_ID ?
            app(MapperSubsystem::class)->setProcessOptions($eventToProcess->getProcessOptions())->process($eventToProcess->getEventData()) :
            null;
    }
}