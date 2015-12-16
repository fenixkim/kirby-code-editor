<?php

/**
 * Code Editor Field for Kirby 2
 *
 * @version   1.0.0
 * @author    Jonas Döbertin <hello@jd-powered.net>
 * @copyright Jonas Döbertin <hello@jd-powered.net>
 * @link      https://github.com/JonasDoebertin/kirby-code-editor
 * @license   GNU GPL v3.0 <http://opensource.org/licenses/GPL-3.0>
 */

class CodeEditorFieldController extends Kirby\Panel\Controllers\Field
{
    /**
     * Load and output an ACE asset file.
     *
     * @since 1.0.0
     *
     * @param string
     */
    public function requireAceAsset($file)
    {
        // Security check
        if (preg_match('/^(?:ext|keybinding|mode|theme|worker)-[a-z_]+\.js$/i', $file) !== 1) {
            die;
        }

        // Load out output file
        $filepath = __DIR__ . DS . 'assets' . DS . 'js' . DS . 'ace' . DS . $file;
        if (file_exists($filepath)) {
            echo file_get_contents($filepath);
        }

        // We're done!
        die;
    }
}
