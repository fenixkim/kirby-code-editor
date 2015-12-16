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
     * Path to Ace assets.
     *
     * @since 1.0.0
     * @var string
     */
    const ACE_ASSETS_PATH = __DIR__ . DS . 'assets' . DS . 'js' . DS . 'ace' . DS;

    /**
     * Define frontend assets.
     *
     * @since 1.0.0
     * @var array
     */
    public static $assets = array(
        'js' => array(
            'ace/ace.js',
            'codeeditorfield.js',
        ),
        'css' => array(
            'panel-overrides.css',
            'ace-overrides.css',
            'codeeditorfield.css',
        ),
    );

    /**
     * Option: Language mode.
     *
     * @since 1.0.0
     * @var string|null
     */
    protected $mode = 'javascript';

    /**
     * Option: Syntax theme.
     *
     * @since 1.0.0
     * @var string
     */
    protected $theme = 'kirby';

    /**
     * Option: Editor height.
     *
     * @since 1.0.0
     * @var string
     */
    protected $height = 'auto';

    /**
     * Custom routes.
     *
     * @since 1.0.0
     * @var array
     */
    protected $routes = [
        [
            'pattern' => 'ace/require/(:any)',
            'method'  => 'get',
            'action'  => 'requireAceAsset',
        ],
    ];

    /**************************************************************************\
    *                          GENERAL FIELD METHODS                           *
    \**************************************************************************/

    /**
     * Return custom routes.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function routes()
    {
        return $this->routes;
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
        // Check if $option is valid and apply sanitized $value
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
        // Check for safe mode names
        if (V::match($value, '/^[a-z0-9_-]+$/i')) {

            // Check if mode file exists
            $path =  self::ACE_ASSETS_PATH . 'mode-' . $value . '.js';
            if (F::exists($path)) {
                return $value;
            }
        }

        return 'text';
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
        // Check for safe theme names
        if (V::match($value, '/^[a-z0-9_-]+$/i')) {

            // Check if theme file exists
            $path =  self::ACE_ASSETS_PATH . 'theme-' . $value . '.js';
            if (F::exists($path)) {
                return $value;
            }
        }

        return 'kirby';
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
     * Create input element.
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
            'editor' => '#' . $this->id() . '-editor',
            'mode'   => $this->mode,
            'theme'  => $this->theme,
            'height' => $this->height,
            'require-path' => purl($this->page(), 'field/' . $this->name() . '/codeeditor/ace/require'),
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

        // Set up code editor element
        $editor = new Brick('div', false);
        $editor->addClass('codeeditor-editor');
        $editor->attr('id', $this->id() . '-editor');
        $editor->append($this->value());

        return $wrapper->append($input)->append($editor);
    }

    /**
     * Create outer field element.
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
}
