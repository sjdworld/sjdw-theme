# SJDW Theme
A custom [WordPress](https://wordpress.org) theme from the house of [SJDWorld](https://sjdworld.com).

[![Code Analysis](https://github.com/sjdworld/sjdw-theme/actions/workflows/analyse.yml/badge.svg)](https://github.com/sjdworld/sjdw-theme/actions/workflows/analyse.yml)

## Installation
Install this theme into your WordPress instance by:

1. Download latest theme archive file from the [Releases](../../releases) page.
2. Go to your WordPress admin area and visit **Themes » Add New** page.
3. Click on the **Upload Theme** button on top of the page and select the theme archive file.
4. After you have selected the file, you need to click on the **Install Now** button.
5. Once installed, go to the **Themes** page in WordPress admin and activate the installed theme.

## Development
Following are the minimum requirements for the development of this project.

- [PHP](https://php.net) version: 8.2 or higher
- [Composer](https://getcomposer.org/) version: 2.0 or higher
- [Node](https://nodejs.org) version: 18.0 or higher

### Environment
Clone or fork the repository and run the following command.

```sh
# Install composer dependencies
$ composer install

# Install node dependencies
$ npm install

# Compile the SCSS and JS files
$ npm run build
```

## CLI Commands
The following are the available CLI commands tailored with this app development. 

### Composer
You can run the scripts from command line with `composer run-script <script-name>`.

| Script Name | Description |
| --- | --- |
| `phpstan` | Analysis all the PHP codebase for any obvious or tricky bugs and errors with [PHPStan](https://phpstan.org). |
| `phpcs` | Check code quality on all the PHP files based on [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/) |
| `phpcbf` | Fix codes on all the PHP files based on [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/) |
| `phpunit` | Run [PHPUnit](https://phpunit.de) test against all the PHP files. |

### Node
You can run the scripts from command line with `npm run <script-name>`.

| Script Name | Description |
| --- | --- |
| `build` | Build and compile all the SCSS and JS files. |
| `fix` | Style fix all the SCSS, CSS and JS files based on [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/). |
| `check` | Check code quality for all the SCSS, CSS and JS files based on [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/). |

## Contributing
Check out the [CONTRIBUTING.md](CONTRIBUTING.md) file for detailed guidelines on getting started and contributing to this project.

## Changelog
All the notable changes to this project will be documented in [CHANGELOG.md](CHANGELOG.md) file.

## License
This project is licensed under the MIT License. See [LICENSE](LICENSE.md) for more information.
