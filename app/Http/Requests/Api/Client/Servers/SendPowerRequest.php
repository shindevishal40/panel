<?php

namespace Pterodactyl\Http\Requests\Api\Client\Servers;

use Pterodactyl\Models\Permission;
use Pterodactyl\Http\Requests\Api\Client\ClientApiRequest;

class SendPowerRequest extends ClientApiRequest
{
    /**
     * Determine if the user has permission to send a power command to a server.
     *
     * @return string
     */
    public function permission(): string
    {
        switch ($this->input('signal')) {
            case 'start':
                return Permission::ACTION_CONTROL_START;
            case 'stop':
                return Permission::ACTION_CONTROL_STOP;
            case 'restart':
                return Permission::ACTION_CONTROL_RESTART;
            case 'kill':
                return Permission::ACTION_CONTROL_KILL;
        }

        return '__invalid';
    }

    /**
     * Rules to validate this request against.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'signal' => 'required|string|in:start,stop,restart,kill',
        ];
    }
}
