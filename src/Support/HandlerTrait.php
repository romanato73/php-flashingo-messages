<?php


namespace Romanato\FlashingoMessage\Support;


use Exception;

trait HandlerTrait
{
    /**
     * Initialize Flashingo Messages handler.
     */
    private function initializeFlashingoMessages() {
        try {
            // Create a session array to hold flashingo messages
            $_SESSION['flashingo'] = [];
            foreach ($this->types as $type) {
                $_SESSION['flashingo'][$type] = [];
            }
            // Check if session is set
            if (!array_key_exists('flashingo', $_SESSION)) {
                throw new Exception('Can not initialize session.');
            }
        } catch (Exception $exception) {
            $this->sessionNotSet($exception->getMessage());
        }
    }

    /**
     * Add flash to session handler.
     *
     * @param string $message
     * @param string $type
     * @param string|array $options
     */
    private function add($message, $type, $options)
    {
        // Create id for item
        $itemId = uniqid();

        // If no options set initialize empty array
        if (is_string($options) && empty($options)) {
            $options = [];
        }

        if (in_array('name', array_keys($options))) {
            $itemId = $options['name'];
        }

        // Check if type exists in available types
        $this->checkType($type);
        // Check if options exists in available options
        $this->checkOptions($options);

        $item = [
            'type' => $type,
            'message' => $message,
            'options' => $options
        ];

        // Set session
        $_SESSION['flashingo'][$type][$itemId] = $item;
    }

    /**
     * Check type handler.
     *
     * @param string $type
     */
    private function checkType($type)
    {
        try {
            if (!in_array($type, $this->types)) {
                throw new Exception("Type ${type} is not defined.");
            }
        } catch (Exception $exception) {
            $this->unknownType($exception->getMessage());
        }
    }

    /**
     * Check options handler.
     *
     * @param array $options
     */
    private function checkOptions($options)
    {
        try {
            foreach ($options as $option => $value) {
                if (!in_array($option, $this->options)) {
                    throw new Exception("Option ${option} is not defined.");
                }
            }
        } catch (Exception $exception) {
            $this->unknownType($exception->getMessage());
        }
    }

    /**
     * Display all flash messages handler.
     */
    private function displayAllFlashingos()
    {
        foreach ($_SESSION['flashingo'] as $items) {
            if (!empty($items)) {
                foreach ($items as $id => $item) {
                    $this->show($item);
                    $this->clearSession($id);
                }
            }
        }
    }

    /**
     * Display unique flash message with id handler.
     */
    private function displayOneFlashingo($name)
    {
        if ($this->hasName($name)) {
            $item = $this->hasName($name);
            $this->show($item[array_keys($item)[0]]);
            $this->clearSession(array_keys($item)[0]);
        }
    }

    /**
     * Check if item has name property.
     *
     * @param string $name
     * @return bool|array
     */
    private function hasName($name) {
        foreach ($_SESSION['flashingo'] as $type) {
            foreach ($type as $id => $item) {
                if (in_array($name, $item['options'])) {
                    return [$id => $item];
                }
            }
        }

        return false;
    }

    /**
     * Generate HTML for item.
     *
     * @param array $item
     */
    private function show($item)
    {
        foreach ($this->types as $type) {
            if ($type == $item['type']) {
                $type = $this->getType($type);
                if (in_array('class', array_keys($item['options']))) {
                    echo "<div class='{$this->cssDefaultClass} alert-{$type} {$item['options']['class']}' role='alert'>{$item['message']}</div>";
                } else {
                    echo "<div class='{$this->cssDefaultClass} alert-{$type}' role='alert'>{$item['message']}</div>";
                }
            }
        }
    }

    /**
     * Get type of message.
     *
     * @param string $type
     * @return mixed
     */
    private function getType($type)
    {
        $types = [
            'default' => 'primary',
            'error' => 'danger',
            'warning' => 'warning',
            'info' => 'info',
            'success' => 'success'
        ];

        try {
            foreach ($types as $key => $value) {
                if ($type == $key) {
                    return $value;
                }
            }

            throw new Exception("Type {$type} is not defined.");
        } catch (Exception $exception) {
            $this->unknownType($exception->getMessage());
        }

        return false;
    }

    /**
     * Clear the session of flash message.
     *
     * @param string $id
     */
    private function clearSession($id)
    {
        // Check if item with id exists
        foreach ($_SESSION['flashingo'] as $type) {
            foreach ($type as $itemId => $item) {
                if ($itemId == $id) {
                    unset($_SESSION['flashingo'][$item['type']][$itemId]);
                }
            }
        }
    }
}