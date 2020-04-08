<?php

namespace Romanato\FlashingoMessage;


class FlashingoMessage
{

    use Support\HandlerTrait;

    /**
     * Set available types and their classes.
     *
     * @var array
     */
    public $types = [
        'default' => 'alert-primary',
        'error' => 'alert-error',
        'warning' => 'alert-warning',
        'info' => 'alert-info',
        'success' => 'alert-success'
    ];

    /**
     * Set available options.
     *
     * @var array
     */
    public $options = [
        'name', 'class',
    ];

    /**
     * Set default class for alert
     *
     * @var string
     */
    public $cssDefaultClass = 'alert';

    /**
     * Initialize FlashingoMessage.
     */
    public function __construct()
    {
        $this->initializeFlashingoMessages();
    }

    /**
     * Set a flash message.
     *
     * @param string $message
     * @param string $type
     * @param array $options
     */
    public function set($message, $type = 'default', $options = [])
    {
        $this->add($message, $type, $options);
    }

    /**
     * Set a default flash message.
     *
     * @param string $message
     * @param array $options
     */
    public function setDefault($message, $options = [])
    {
        $this->add($message, 'default', $options);
    }

    /**
     * Set an error flash message.
     *
     * @param string $message
     * @param array $options
     */
    public function setError($message, $options = [])
    {
        $this->add($message, 'error', $options);
    }

    /**
     * Set a warning flash message.
     *
     * @param string $message
     * @param array $options
     */
    public function setWarning($message, $options = [])
    {
        $this->add($message, 'warning', $options);
    }

    /**
     * Set a info flash message.
     *
     * @param string $message
     * @param array $options
     */
    public function setInfo($message, $options = [])
    {
        $this->add($message, 'warning', $options);
    }

    /**
     * Set a success flash message.
     *
     * @param string $message
     * @param array $options
     */
    public function setSuccess($message, $options = [])
    {
        $this->add($message, 'warning', $options);
    }

    /**
     * Display unique flash message with id.
     *
     * @param string $name
     */
    public function display($name)
    {
        $this->displayOneFlashingo($name);
    }

    /**
     * Display all flash messages.
     */
    public function displayAll()
    {
        $this->displayAllFlashingos();
    }

    /**
     * Clear session.
     */
    public function destroyAll()
    {
        $this->clearAllFlashingos();
    }

    /**
     * TODO: hasError, hasWarning, hasInfo, hasSuccess
     * TODO: displayError, displayWarning, displayInfo, displaySuccess
     */
}