# Kirby Code Editor

**Based on [Ace](https://ace.c9.io).**

[![Release](https://img.shields.io/github/release/jonasdoebertin/kirby-code-editor.svg)](https://github.com/jonasdoebertin/kirby-code-editor/releases)  [![Issues](https://img.shields.io/github/issues/jonasdoebertin/kirby-code-editor.svg)](https://github.com/jonasdoebertin/kirby-code-editor/issues) [![License](https://img.shields.io/badge/license-GPLv3-blue.svg)](https://raw.githubusercontent.com/jonasdoebertin/kirby-code-editor/master/LICENSE)
[![Moral License](https://img.shields.io/badge/buy-moral_license-8dae28.svg)](https://gumroad.com/l/visualmarkdown)

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
    text:
        label: Code
        type:  codeeditor
        mode:  javascript
```
