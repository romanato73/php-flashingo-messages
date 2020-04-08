<?php


namespace Romanato\FlashingoMessage\Support;


trait HandlerTrait
{
    /**
     * Initialize Flashingo Messages handler.
     */
    protected function initializeFlashingoMessages()
    {
        try {
            // Create a session array to hold flashingo messages
            $_SESSION['flashingo'] = [];
            // Check if session is set
            if (!array_key_exists('flashingo', $_SESSION)) {
                throw new Exception('Can not initialize session.');
            }
        } catch (Exception $exception) {
            die($exception->sessionNotSet());
        }
    }

    /**
     * Add flash to session handler.
     *
     * @param string $message
     * @param string $type
     * @param string|array $options
     */
    protected function add($message, $type, $options)
    {
        // Create id for item
        $itemId = uniqid();

        // If no options set initialize empty array
        if (is_string($options) && empty($options)) {
            $options = [];
        }

        // Set custom name if defined
        if (in_array('name', array_keys($options))) {
            $itemId = $options['name'];
        }

        // Check if type exists in available types
        $this->checkType($type);
        // Check if options exists in available options
        $this->checkOptions($options);

        // Create item array
        $item = [
            'type' => $type,
            'message' => $message,
            'options' => $options
        ];

        // Set session
        $_SESSION['flashingo'][$itemId] = $item;
    }

    /**
     * Check type handler.
     *
     * @param string $type
     */
    protected function checkType($type)
    {
        try {
            if (!in_array($type, array_keys($this->types))) {
                throw new Exception("Type ${type} is not defined.");
            }
        } catch (Exception $exception) {
            die($exception->unknownType());
        }
    }

    /**
     * Check options handler.
     *
     * @param array $options
     */
    protected function checkOptions($options)
    {
        try {
            foreach (array_keys($options) as $option) {
                if (!in_array($option, $this->options)) {
                    throw new Exception("Option ${option} is not defined.");
                }
            }
        } catch (Exception $exception) {
            die($exception->unknownType());
        }
    }

    /**
     * Display all flash messages handler.
     */
    protected function displayAllFlashingos()
    {
        // Loop through all flash messages in session
        foreach ($_SESSION['flashingo'] as $id => $item) {
            if (!empty($item)) {
                // Show all flash messages
                $this->show($item);
                // Clear session for all flash messages
                $this->clearSession($id);
            }
        }
    }

    /**
     * Generate HTML for item.
     *
     * @param array $item
     */
    protected function show($item)
    {
        foreach (array_keys($this->types) as $key) {
            if ($key == $item['type']) {
                $class = $this->getClass($key);
                if (in_array('class', array_keys($item['options']))) {
                    echo "<div class='{$this->cssDefaultClass} {$class} {$item['options']['class']}' role='alert'>{$item['message']}</div>";
                } else {
                    echo "<div class='{$this->cssDefaultClass} {$class}' role='alert'>{$item['message']}</div>";
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
    protected function getClass($type)
    {
        foreach ($this->types as $key => $value) {
            if ($type == $key) {
                return $value;
            }
        }

        return $type;
    }

    /**
     * Clear the session of flash message.
     *
     * @param string $id
     */
    protected function clearSession($id)
    {
        // Check if item with id exists
        foreach (array_keys($_SESSION['flashingo']) as $itemId) {
            if ($itemId == $id) {
                unset($_SESSION['flashingo'][$itemId]);
            }
        }
    }

    /**
     * Display unique flash message with id handler.
     *
     * @param string $name
     */
    protected function displayOneFlashingo($name)
    {
        // Check if that name exists
        if ($this->hasName($name)) {
            // Set new item
            $item = $this->hasName($name);
            // Show item
            $this->show($item[$name]);
            // Clear item's session
            $this->clearSession($name);
        }
    }

    /**
     * Check if item has name property.
     *
     * @param string $name
     * @return bool|array
     */
    protected function hasName($name)
    {
        foreach ($_SESSION['flashingo'] as $id => $item) {
            if (in_array($name, $item['options'])) {
                return [$id => $item];
            }
        }

        return false;
    }

    /**
     * Clear session handler.
     */
    protected function clearAllFlashingos()
    {
        // Unset all items
        unset($_SESSION['flashingo']);
        // Initialize Flashingo Messages
        $this->initializeFlashingoMessages();
    }
}