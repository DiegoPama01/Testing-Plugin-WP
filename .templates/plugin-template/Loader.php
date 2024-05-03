<?php

namespace __templateNameToPascalCase__;

/**
 * Class Loader
 * 
 * A class to handle loading and enqueuing scripts and styles in WordPress.
 */
class Loader
{
    /**
     * @var string $urlDst The URL path to the destination JSON file.
     */
    private $urlDst;

    /**
     * Constructor for the Loader class.
     *
     * @param string $urlPathDst The URL path to the destination JSON file.
     */
    public function __construct($urlPathDst)
    {
        $this->urlDst = $urlPathDst;
    }

    /**
     * Load and enqueue scripts from the specified directory.
     *
     * @param string $srcDir The directory path where the scripts are located.
     */
    public function loadScripts($srcDir)
    {
        $directoryPath = plugins_url($srcDir, __FILE__);
        $files = glob($directoryPath . '*.js');

        $jsonFile = plugins_url($this->urlDst, __FILE__);
        $jsonData = file_get_contents($jsonFile);
        $data = json_decode($jsonData, true);

        foreach ($files as $scriptFile) {
            $scriptName = basename($scriptFile);
            $scriptHandle = sanitize_title($scriptName);

            $scriptExists = false;
            foreach ($data['scripts'] as $script) {
                if ($script['file'] === $scriptName) {
                    $scriptExists = true;
                    break;
                }
            }

            //Insert the script if not exist
            if (!$scriptExists) {
                $data['scripts'][] = [
                    "file" => $scriptName,
                    "handle" => $scriptHandle,
                    "dependencies" => [],
                    "version" => false,
                    "in_footer" => true
                ];
            }
        }

        file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));

        foreach ($data['scripts'] as $script) {
            wp_enqueue_script(
                $script['handle'],
                plugins_url($srcDir . $script['file'], __FILE__),
                $script['dependencies'],
                $script['version'],
                $script['in_footer']
            );
        }
    }

    /**
     * Load and enqueue styles from the specified directory.
     *
     * @param string $srcDir The directory path where the styles are located.
     */
    public function loadStyles($srcDir)
    {
        $directoryPath = plugins_url($srcDir, __FILE__);
        $files = glob($directoryPath . '*.css');

        $jsonFile = plugins_url($this->urlDst, __FILE__);
        $jsonData = file_get_contents($jsonFile);
        $data = json_decode($jsonData, true);

        foreach ($files as $styleFile) {
            $styleName = basename($styleFile);
            $styleHandle = sanitize_title($styleName);

            $styleExists = false;
            foreach ($data['styles'] as $style) {
                if ($style['file'] === $styleName) {
                    $styleExists = true;
                    break;
                }
            }

            //Insert the style if not exist
            if (!$styleExists) {
                $data['styles'][] = [
                    "file" => $styleName,
                    "handle" => $styleHandle,
                    "dependencies" => [],
                    "version" => false,
                    "media" => 'all'
                ];
            }
        }

        file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));

        foreach ($data['styles'] as $style) {
            wp_enqueue_style(
                $style['handle'],
                plugins_url($srcDir . $style['file'], __FILE__),
                $style['dependencies'],
                $style['version'],
                $style['media']
            );
        }
    }
}
