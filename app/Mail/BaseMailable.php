<?php

namespace App\Mail;

use Illuminate\Container\Container;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Mail\Mailer as MailerContract;

class BaseMailable extends Mailable
{
    /**
     * Validate email addresses and call parent send.
     *
     * @param  \Illuminate\Contracts\Mail\Mailer  $mailer
     * @return void
     */
    public function send(MailerContract $mailer)
    {
        $mailClone = clone $this;

        // chamando o método build para criar o email
        $mailClone->build();
        $to = $mailClone->to;
        unset($mailClone);

        // verificando se o to é vazio, se não for envia o email
        // vem vazio nos casos de Fluig
        if (!empty($to)) {
            parent::send($mailer);
        }
    }

    /**
     * Remove empty addresses of recipients
     *
     * @param  object|array|string  $address
     * @return array
     */
    protected function removeEmptyAddresses($addresses)
    {
        $normalizedAddresses = $this->normalizeRecipient($addresses) ?? (object) [];
        return array_values(
            array_filter(get_object_vars($normalizedAddresses), function ($address) {
                return isset($address['email']) ? !empty($address['email']) : !empty($address);
            })
        );
    }

    /**
     * Validate addresses and call parent setAddress.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @param  string  $property
     * @return $this
     */
    protected function setAddress($address, $name = null, $property = 'to')
    {
        $addresses = $this->removeEmptyAddresses($address);
        if (!empty($addresses)) {
            return parent::setAddress(
                count($addresses) === 1 && !isset($addresses[0]['name']) ? $addresses[0] : $addresses,
                $name,
                $property
            );
        }
        return $this;
    }
}
