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

/**
 * Code Editor Field
 *
 * @since 1.0.0
 */
class CodeEditorField extends InputField {

    /**
     * Language files directory
     *
     * @since 1.2.0
     */
    const LANG_DIR = 'languages';

    /**
     * Define frontend assets
     *
     * @var array
     * @since 1.0.0
     */
    public static $assets = array(
        'js' => array(
            'codemirror-compressed-5.8.0.min.js',
            'codeeditorfield.js',
        ),
        'css' => array(
            'codemirror-5.8.0.css',
            'codemirror-theme-material-5.8.0.css',
            'codemirror-theme-monokai-5.8.0.css',
            'codeeditorfield.css',
        ),
    );

    /**
     * Option: Language mode.
     *
     * @since 1.0.0
     *
     * @var string|null
     */
    protected $mode = 'text';

    /**
     * Option: Syntax theme.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $theme = 'material';

    /**
     * Option: Editor height.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $height = 'auto';

    /**
     * Translated strings
     *
     * @since 1.2.0
     *
     * @var array
     */
    protected $translation;

    /**************************************************************************\
    *                          GENERAL FIELD METHODS                           *
    \**************************************************************************/

    /**
     * Field setup.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        // Load language files
        // $baseDir = __DIR__ . DS . self::LANG_DIR . DS;
        // $lang = panel()->language();
        // if(file_exists($baseDir . $lang . '.php')) {
        //     $this->translation = include $baseDir . $lang . '.php';
        // } else {
        //     $this->translation = include $baseDir . 'en.php';
        // }
    }

    /**
     * Magic setter.
     *
     * Set a fields property and apply default value if required.
     *
     * @since 1.0.0
     *
     * @param string $option
     * @param mixed  $value
     */
    public function __set($option, $value)
    {
        // Check if value is valid and apply sanitized value
        switch ($option) {
            case 'mode':
                $this->$option = $this->sanitizeModeOption($value);
                break;

            case 'theme':
                $this->$option = $this->sanitizeThemeOption($value);
                break;

            case 'height':
                $this->$option = $this->sanitizeHeightOption($value);
                break;
        }
    }

    /**
     * Sanitize "mode" option.
     *
     * @since 1.0.0
     *
     * @param string
     * @return string
     */
    protected function sanitizeModeOption($value)
    {
        return (in_array($value, array('css', 'javascript'))) ? $value : 'text';
    }

    /**
     * Sanitize "theme" option.
     *
     * @since 1.0.0
     *
     * @param string
     * @return string
     */
    protected function sanitizeThemeOption($value)
    {
        return (in_array($value, array('material', 'monokai'))) ? $value : 'material';
    }

    /**
     * Sanitize "height" option.
     *
     * @since 1.0.0
     *
     * @param string
     * @return integer|string
     */
    protected function sanitizeHeightOption($value)
    {
        return (is_numeric($value)) ? $value : 'auto';
    }

    /**************************************************************************\
    *                            PANEL FIELD MARKUP                            *
    \**************************************************************************/

    /**
     * Create input element
     *
     * @since 1.0.0
     *
     * @return \Brick
     */
    public function input()
    {
        // Set up textarea
        $input = parent::input();
        $input->tag('textarea');
        $input->removeAttr('type');
        $input->removeAttr('value');
        $input->html($this->value() ?: false);
        $input->data(array(
            'field'  => 'codeeditorfield',
            'mode'   => $this->mode,
            'theme'  => $this->theme,
            'height' => $this->height,
        ));

        /**
         * FIX: Prevent Google Chrome from trying to validate the underlying
         * invisible textarea. The Panel will handle this instead.
         *
         * See: https://github.com/JonasDoebertin/kirby-visual-markdown/issues/42
         */
        $input->removeAttr('required');

        // Set up wrapping element
        $wrapper = new Brick('div', false);
        $wrapper->addClass('codeeditor-wrapper');
        $wrapper->addClass('codeeditor-field-' . $this->name);

        if ($this->height === 'auto') {
            $wrapper->addClass('codeeditor-field-autoheight');
        }

        return $wrapper->append($input);
    }

    /**
     * Create outer field element
     *
     * @since 1.0.0
     *
     * @return \Brick
     */
    public function element()
    {
        $element = parent::element();
        $element->addClass('field-with-codeeditor');
        return $element;
    }

    /**************************************************************************\
    *                                 HELPERS                                  *
    \**************************************************************************/

    /**
     * Return a translation from the internal translation storage
     *
     * @since 1.0.0
     *
     * @param  string $key
     * @param  string $default
     * @return string
     */
    public function lang($key, $default = '')
    {
        return (isset($this->translation[$key]) ? $this->translation[$key] : $default);
    }

}
