# Kirby Code Editor

[![Kirby Code Editor](https://raw.githubusercontent.com/JonasDoebertin/kirby-code-editor/master/logo.png)](https://github.com/JonasDoebertin/kirby-code-editor/)


**Based on [Ace](https://ace.c9.io).**

[![Release](https://img.shields.io/github/release/jonasdoebertin/kirby-code-editor.svg)](https://github.com/jonasdoebertin/kirby-code-editor/releases)  [![Issues](https://img.shields.io/github/issues/jonasdoebertin/kirby-code-editor.svg)](https://github.com/jonasdoebertin/kirby-code-editor/issues) [![License](https://img.shields.io/badge/license-GPLv3-blue.svg)](https://raw.githubusercontent.com/jonasdoebertin/kirby-code-editor/master/LICENSE)
[![Moral License](https://img.shields.io/badge/buy-moral_license-8dae28.svg)](https://gumroad.com/l/codeeditor)

A dead-simple code editor field for the [Kirby Panel](http://getkirby.com). Just drop in the plugin and you're good to go!

## Requirements

* **Kirby 2.2 or above**
* **PHP 5.4 or above**

## Installation

### Copy & Pasting

If not already existing, add a new `fields` folder to your `site` directory. Then copy or link this repositories whole content in a new `codeeditor` folder there. Afterwards, your directory structure should look similar to this:

```
site/
	fields/
		codeeditor/
			assets/
			codeeditor.php
            ...
```

### Git Submodule

If you are an advanced user and know your way around Git and you already use Git to manage you project, you can make updating this field extension to newer releases a breeze by adding it as a Git submodule.

```bash
$ cd your/project/root
$ git submodule add https://github.com/JonasDoebertin/kirby-code-editor.git site/fields/codeeditor
```

Updating all your Git submodules (eg. the Kirby core modules and any extensions added as submodules) to their latest version, all you need to do is to run these two Git commands.

```bash
$ cd your/project/root
$ git submodule foreach --recursive git checkout master
$ git submodule foreach --recursive git pull
```

## Usage
Using the field in your blueprint couldn't be easier. After installing the plugin like explained above, all you need to do is change the `type` of a regular `textarea` field to `codeeditor`.

```yaml
fields:
    title:
        label: Code Snippet Title
        type:  text
    code:
        label: Code
        type:  codeeditor
        mode:  javascript
```

## Options

### mode

Set the syntax mode of the editor field. Currently supported modes are:

* `coffee`
* `css`
* `html`
* `javascript`
* `json`
* `less`
* `markdown`
* `php`
* `plain_text`
* `sass`
* `scss`
* `svg`
* `text`
* `xml`
* `yaml`

### theme

Set the syntax theme of the editor field. By default there's only a single theme included, called `kirby`, which has been custom build to fit perfectly into the Panel.

### height

Set the editor fields (max) height. Define a number of lines the editor will show at most. If your content has more lines then you specified here, the editor will make it available through vertical scrolling. If you want make the editor adapt to your content you may set this option to `auto`.

## Advanced

### Using additional Ace syntax modes and themes

Even though the underlying Ace Editor does support a lot of different syntax modes and themes, Kirby Code Editor only includes the most requested ones to reduce its overall weight. If you want to use any mode or theme that is not included by default, go over to the [ace-builds](https://github.com/ajaxorg/ace-builds/tree/master/src-min-noconflict) repository, choose your desired mode and theme files `mode-*.js` / `theme-*.js` and drop them into the fields `assets/js/ace` directory. Afterwards you can use them with the *mode* and *theme* option just like the included ones.
