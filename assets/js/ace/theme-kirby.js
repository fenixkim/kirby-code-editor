ace.define("ace/theme/kirby",["require","exports","module","ace/lib/dom"],function(e,t,n){t.isDark=false,t.cssClass="ace-kirby",t.cssText="\
.ace-kirby { background-color: #FAFAFA; color: #90A4AE } \
.ace-kirby .ace_gutter {background: #FAFAFA; color: rgb(197,207,212)} \
.ace-kirby .ace_cursor { color: rgba(39, 39, 39, 0.56) } \
.ace-kirby .ace_print-margin { width: 1px; background: #e8e8e8 } \
.ace-kirby .ace_marker-layer .ace_step { background: rgb(198, 219, 174) } \
.ace-kirby .ace_marker-layer .ace_bracket { margin: -1px 0 0 -1px; border: 1px solid #E7EAEC } \
.ace-kirby .ace_marker-layer .ace_selection { background: rgba(128, 203, 196, 0.25) } \
.ace-kirby .ace_marker-layer .ace_active-line { background: rgba(144, 164, 174, 0.13) } \
.ace-kirby .ace_marker-layer .ace_selected-word { border: 1px solid rgba(128, 203, 196, 0.25) } \
.ace-kirby.ace_multiselect .ace_selection.ace_start { box-shadow: 0 0 3px 0px #FAFAFA; border-radius: 2px } \
.ace-kirby .ace_gutter-active-line { background-color: rgba(144, 164, 174, 0.13) } \
.ace-kirby .ace_fold { background-color: rgb(97, 130, 184); border-color: #90A4AE } \
.ace-kirby .ace_keyword { color: rgb(148, 94, 184) } \
.ace-kirby .ace_keyword.ace_operator { color: rgb(63, 179, 168) } \
.ace-kirby .ace_keyword.ace_other.ace_unit { color: #E53935 } \
.ace-kirby .ace_constant { color: #FF9900 } \
.ace-kirby .ace_constant.ace_numeric { color: #E53935 } \
.ace-kirby .ace_constant.ace_character.ace_escape { color: #E53935 } \
.ace-kirby .ace_support.ace_function { color: rgb(63, 179, 168) } \
.ace-kirby .ace_support.ace_class { color: #EBB060 } \
.ace-kirby .ace_storage { color: rgb(148, 94, 184) } \
.ace-kirby .ace_invalid.ace_illegal { color: #FFFFFF; background-color: rgb(184, 58, 66) } \
.ace-kirby .ace_invalid.ace_deprecated { color: #FFFFFF; background-color: rgb(184, 21, 17) } \
.ace-kirby .ace_string { color: rgb(145, 184, 89) } \
.ace-kirby .ace_string.ace_regexp { color: rgb(63, 179, 168) } \
.ace-kirby .ace_comment { color: #B0BEC5 } \
.ace-kirby .ace_variable { color: #597078 } \
.ace-kirby .ace_meta.ace_tag { color: rgb(63, 179, 168) } \
.ace-kirby .ace_meta.ace_selector { color: rgb(148, 94, 184) } \
.ace-kirby .ace_entity.ace_other.ace_attribute-name { color: #FFA000 } \
.ace-kirby .ace_entity.ace_name.ace_function { color: rgb(97, 130, 184) } \
.ace-kirby .ace_entity.ace_name.ace_tag { color: #FF5370 } \
.ace-kirby .ace_markup.ace_list { color: #FF5370 } \
.ace-kirby .ace_indent-guide {background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAACCAYAAACZgbYnAAAAE0lEQVQImWP4////f4bLly//BwAmVgd1/w11/gAAAABJRU5ErkJggg==) right repeat-y} \
.ace-kirby .ace_gutter-cell.ace_info { background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd' stroke-linejoin='round' stroke-miterlimit='1.414'%3E%3Cpath d='M9 13h2v2H9v-2zm0-8h2v6H9V5zm.99-5C4.47 0 0 4.48 0 10s4.47 10 9.99 10C15.52 20 20 15.52 20 10S15.52 0 9.99 0zM10 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z' fill='%23abbfca' fill-rule='nonzero'/%3E%3C/svg%3E\"); background-size: 14px; background-position: 3px center} \
.ace-kirby .ace_gutter-cell.ace_warning { background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 22 19' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd' stroke-linejoin='round' stroke-miterlimit='1.414'%3E%3Cpath d='M0 19h22L11 0 0 19zm12-3h-2v-2h2v2zm0-4h-2V8h2v4z' fill='%23ffa000' fill-rule='nonzero'/%3E%3C/svg%3E\"); background-size: 16px; background-position: 2px center }\
.ace-kirby .ace_gutter-cell.ace_error { background-image: url(\"data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd' stroke-linejoin='round' stroke-miterlimit='1.414'%3E%3Cpath d='M10 0C4.48 0 0 4.48 0 10s4.48 10 10 10 10-4.48 10-10S15.52 0 10 0zm1 15H9v-2h2v2zm0-4H9V5h2v6z' fill='%23e53935' fill-rule='nonzero'/%3E%3C/svg%3E\"); background-size: 14px; background-position: 3px center } \
";var r=e("../lib/dom");r.importCssString(t.cssText,t.cssClass)})
