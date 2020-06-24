<?php

namespace App\Services\Responses;

use Exception;
use App\Services\Responses\InternalError;

class ServiceResponse
{
    /**
     * @var bool
     */
    public $success;

    /**
     * @var string
     */
    public $message;

    /**
     * @var mixed
     */
    public $data;

    /**
     * @param bool   $success
     * @param string $message
     * @param mixed  $data
     */
    public function __construct(
        bool $success,
        string $message,
        $data = null
    ) {
        $this->success        = $success;
        $this->message        = $message;
        $this->data           = $data;
    }

    /**
     * Retorna as propriedades dessa classe em array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'success'        => $this->success,
            'message'        => $this->message,
            'data'           => $this->data
        ];
    }
}
