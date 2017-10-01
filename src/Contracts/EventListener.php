<?php

namespace TwoDojo\Module\Contracts;

interface EventListener
{
    /**
     * @param string $event
     * @param array $arguments
     * @return void
     */
    public function onEventReceived(string $event, array $arguments = []);

    /**
     * @return string
     */
    public function getEventGroup();
}
