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
            'codeeditor.js',
        ),
        'css' => array(
            'codemirror-5.8.0.css',
            'codeeditor.css',
        ),
    );

    /**
     * Translated strings
     *
     * @since 1.2.0
     *
     * @var array
     */
    protected $translation;

    /**
     * Default option values
     *
     * @since 1.2.0
     *
     * @var array
     */
    protected $defaultValues = array();

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
        $baseDir = __DIR__ . DS . self::LANG_DIR . DS;
        $lang = panel()->language();
        if(file_exists($baseDir . $lang . '.php')) {
            $this->translation = include $baseDir . $lang . '.php';
        } else {
            $this->translation = include $baseDir . 'en.php';
        }
    }

    // /**
    //  * Magic setter
    //  *
    //  * Set a fields property and apply default value if required.
    //  *
    //  * @since 1.1.0
    //  *
    //  * @param string $option
    //  * @param mixed  $value
    //  */
    // public function __set($option, $value)
    // {
    //     /* Set given value */
    //     $this->$option = $value;
    //
    //     /* Check if value is valid */
    //     switch($option)
    //     {
    //         case 'toolbar':
    //             $this->validateToolbarOption($value);
    //             break;
    //
    //         case 'header1':
    //         case 'header2':
    //             $this->validateHeaderOption($option, $value);
    //             break;
    //
    //         case 'tools':
    //             $this->validateToolsOption($value);
    //             break;
    //     }
    //
    // }

    // /**
    //  * Validate "toolbar" option
    //  *
    //  * @since 1.3.0
    //  *
    //  * @param mixed $value
    //  */
    // protected function validateToolbarOption($value)
    // {
    //     $this->toolbar = !in_array($value, array('false', 'hide', 'no', false));
    // }

    // /**
    //  * Validate "headerX" option
    //  *
    //  * @since 1.3.0
    //  *
    //  * @param string $header
    //  * @param array  $value
    //  */
    // protected function validateHeaderOption($header, $value)
    // {
    //     if(!in_array($value, $this->validHeaderValues))
    //     {
    //         $this->$header = $this->defaultValues[$header];
    //     }
    // }

    // /**
    //  * Validate "tools" option
    //  *
    //  * @since 1.3.0
    //  *
    //  * @param array $value
    //  */
    // protected function validateToolsOption($value)
    // {
    //     if(!is_array($value) or empty($value))
    //     {
    //         $this->tools = $this->defaultValues['tools'];
    //     }
    // }

    // /**
    //  * Convert result to markdown
    //  *
    //  * @since 1.0.0
    //  *
    //  * @return string
    //  */
    // public function result()
    // {
    //     return str_replace(array("\r\n", "\r"), "\n", parent::result());
    // }

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
            'field'     => 'codeeditorfield',
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
        $wrapper->addClass('markdownfield-wrapper');
        $wrapper->addClass('markdownfield-field-' . $this->name);

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
