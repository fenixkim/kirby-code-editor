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

    this.$wrapper = this.$field.closest('.codeeditor-wrapper');

    this.$editor = $(this.$field.data('editor'));

    /**
     * User defined codemirror options.
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
     * CodeMirror instance.
     *
     * @since 1.0.0
     */
    this.editor = null;

    this.isFocused = false;

    /**
     * Initialization.
     *
     * @since 1.0.0
     */
    this.init = function () {
        // Initialize CodeMirror
        self.initEditor();

        // Add styles for custom, fixed height
        // if (self.options.height !== 'auto') {
        //     self.initHeight();
        // }

        // Set up change event handler
        self.editor.on('change', self.updateStorage);

        // Set up focus and blur event handlers
        self.editor.on('focus', self.attachFocusStyles);
        self.editor.on('blur', self.detachFocusStyles);

        /**
         * Observe when the field element is destroyed (=the user leaves the
         * current view) and deactivate MirrorMark accordingly.
         *
         * @since 1.0.0
         */
        // self.$field.bind('destroyed', function() {
        //     self.deactivate();
        // });
    };

    /**
     * Initialize CodeMirror.
     *
     * @since 1.0.0
     */
    this.initEditor = function () {
        ace.config.set('basePath', self.options.requirePath);

        // Initialize editor
        self.editor = ace.edit(self.$editor.get(0));
        self.editor.setTheme('ace/theme/' + self.options.theme);
        self.editor.session.setMode('ace/mode/' + self.options.mode);

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
     * Set the CodeMirror instance to a fixed size.
     *
     * @since 1.0.0
     */
    this.initHeight = function () {
        self.$field.parent().find('.CodeMirror').css('height', self.options.height + 'px');
    };

    /**
     * Deactivate & destroy.
     *
     * @since 1.0.0
     */
    this.deactivate = function () {
        self.codemirror.toTextArea();
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
     * @see https://github.com/getkirby/panel/issues/228#issuecomment-58379016
     * @since 1.0.0
     */
    $.fn.codeeditorfield = function() {
        return new CodeEditorField($, this);
    };

})(jQuery);
