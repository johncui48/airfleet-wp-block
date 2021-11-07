# Airfleet Block

Created a new child theme from [Twenty Twenty-One](https://wordpress.org/themes/twentytwentyone/) and added a Airfleet custom block using [ACF Pro](https://www.advancedcustomfields.com/pro/).

## Specification

Prerequisites:

* Check you have already installed [Twenty Twenty-One](https://wordpress.org/themes/twentytwentyone/).
* Check you have already installed [ACF Pro](https://www.advancedcustomfields.com/pro/) plugin.

Used:

* Bootstrap
* jQuery
* ACF Pro

## Running

* Download this as a zip file and upload/install new theme.

## Development

```bash
# Install the dependencies.
$ cd .
$ npm install
```

* In functions.php, register a new block name under custom_acf_init_blocks() function.
* In custom-blocks folder, create a new folder with block name and add files (php for callback or template, javascript, scss for stylesheet, json for acf custom fields group)