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
var CodeEditorField = function ($, $field) {
    'use strict';

    /**
     * Handy self-reference.
     *
     * @since 1.0.0
     */
    var self = this;

    /**
     * Base textarea element.
     *
     * @since 1.0.0
     */
    this.$field = $field;

    /**
     * Field wrapper element.
     *
     * @since 1.0.0
     */
    this.$wrapper = this.$field.closest('.codeeditor-wrapper');

    /**
     * Base editor element.
     *
     * @since 1.0.0
     */
    this.$editor = $(this.$field.data('editor'));

    /**
     * User defined and fixed ace options.
     *
     * @since 1.0.0
     */
    this.options = {
        mode: this.$field.data('mode'),
        theme: this.$field.data('theme'),
        height: this.$field.data('height'),
        requirePath: this.$field.data('require-path')
    };

    /**
     * Ace instance.
     *
     * @since 1.0.0
     */
    this.editor = null;

    /**
     * Current focus state.
     *
     * @since 1.0.0
     */
    this.isFocused = false;

    /**
     * Initialization.
     *
     * @since 1.0.0
     */
    this.init = function () {
        // Initialize editor
        self.initEditor();

        // Set up change event handler
        self.editor.on('change', self.updateStorage);

        // Set up focus and blur event handlers
        self.editor.on('focus', self.attachFocusStyles);
        self.editor.on('blur', self.detachFocusStyles);

        /**
         * Observe when the field element is destroyed (=the user leaves the
         * current view) and deactivate the editor accordingly.
         *
         * @since 1.0.0
         */
        self.$field.bind('destroyed', function() {
            self.deactivate();
        });
    };

    /**
     * Initialize Ace editor.
     *
     * @since 1.0.0
     */
    this.initEditor = function () {

        // Set our custom require path
        ace.config.set('basePath', self.options.requirePath);

        // Initialize editor
        self.editor = ace.edit(self.$editor.get(0));
        self.editor.setTheme('ace/theme/' + self.options.theme);
        self.editor.session.setMode('ace/mode/' + self.options.mode);

        // Adapt to the Panels font size
        self.editor.setOption('fontSize', '1em');

        // Set height options
        self.editor.setOption('minLines', 5);
        if (self.options.height !== 'auto') {
            self.editor.setOption('maxLines', self.options.height);
        } else {
            self.editor.setOption('maxLines', Infinity);
        }
    };

    /**
     * Deactivate & destroy.
     *
     * @since 1.0.0
     */
    this.deactivate = function () {
        self.editor.destroy();
    };

    /**
     * Update storage textarea element.
     *
     * @since 1.0.0
     */
    this.updateStorage = function () {
        self.$field.text(self.editor.getValue());
    };

    /**
     * Add focus style classes to the editor wrapper.
     *
     * @since 1.0.0
     */
    this.attachFocusStyles = function () {
        self.isFocused = true;
        self.$wrapper.addClass('codeeditor-wrapper-focused');
    };

    /**
     * Remove focus style classes from the editor wrapper.
     *
     * @since 1.0.0
     */
    this.detachFocusStyles = function () {
        self.isFocused = false;
        self.$wrapper.removeClass('codeeditor-wrapper-focused');
    };

    // Run initialization
    this.init();
};

(function($) {
    'use strict';

    /**
     * Set up special "destroyed" event.
     *
     * @since 1.0.0
     */
    $.event.special.destroyed = {
        remove: function(event) {
            if(event.handler) {
                event.handler.apply(this, arguments);
            }
        }
    };

    /**
     * Tell the Panel to run our initialization.
     *
     * This callback will fire for every Code Editor Field
     * on the current panel page.
     * 
     * @since 1.0.0
     */
    $.fn.codeeditorfield = function() {
        return new CodeEditorField($, this);
    };

})(jQuery);
