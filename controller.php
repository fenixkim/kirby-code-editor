<?php

class CodeEditorFieldController extends Kirby\Panel\Controllers\Field
{
    /**
     * Load and output an ACE asset file.
     *
     * @since 1.0.0
     * @param string    $file
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
