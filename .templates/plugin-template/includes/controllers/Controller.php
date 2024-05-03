<?php

namespace __templateNameToPascalCase__\Controllers;

/**
 * Class Controller
 * Abstract class for controllers in the WordPress plugin.
 */
abstract class Controller
{

    /**
     * Array to store WordPress hooks and actions.
     */
    public const hooks = [];

    /**
     * Method to register WordPress hooks and actions required by the controller.
     */
    
    public static function register_hooks() {
        foreach (self::hooks as $hook => $function) {
            add_action($hook, $function);
        }
    }

    // Additional methods for handling hooks can be added here.
}
