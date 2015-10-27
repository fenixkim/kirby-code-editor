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
 * Code Editor CodeMirror Wrapper
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
     * User defined codemirror options.
     *
     * @since 1.0.0
     */
    this.options = {
        mode: this.$field.data('mode'),
        theme: this.$field.data('theme'),
        height: this.$field.data('height')
    };

    /**
     * CodeMirror instance.
     *
     * @since 1.0.0
     */
    this.codemirror = null;

    /**
     * Initialization.
     *
     * @since 1.0.0
     */
    this.init = function () {
        // Initialize CodeMirror
        self.initCodeMirror();

        // Add styles for custom, fixed height
        if (self.options.height !== 'auto') {
            self.initHeight();
        }

        /**
         * Observe when the field element is destroyed (=the user leaves the
         * current view) and deactivate MirrorMark accordingly.
         *
         * @since 1.0.0
         */
        self.$field.bind('destroyed', function() {
            self.deactivate();
        });

        // Refresh CodeMirror DOM
        self.codemirror.refresh();
    };

    /**
     * Initialize CodeMirror.
     *
     * @since 1.0.0
     */
    this.initCodeMirror = function () {
        self.codemirror = CodeMirror.fromTextArea(self.$field.get(0), {
            mode: self.options.mode,
            theme: self.options.theme,
            indentUnit: 4,
            lineWrapping: true,
            lineNumbers: true,
            viewportMargin: (self.options.height === 'auto') ? Infinity : 10
        });
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
