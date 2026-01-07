# Contributing Guidelines
Thank you for your interest in contributing to this project. The following guidelines for contribution should be followed if you want to submit a pull request.

> This document is intended **only for approved team members and contractors**.  
> Unauthorized contributions from outside this team are not accepted.

## Table of Contents
1. [Workflow Overview](#workflow-overview)  
2. [Development Setup](#development-setup)  
3. [Branching & Pull Requests](#branching--pull-requests)  
4. [Coding Standards](#coding-standards)
5. [Code Review & Merging](#code-review--merging)  
6. [Additional Resources](#additional-resources)  

## Workflow Overview
All contributions follow a **strict fork-and-pull workflow**, even for internal developers:

1. Create a branch from the designated `main` branch.  
2. Implement your changes locally.  
3. Push to your branch.  
4. Open a Pull Request (PR) for review.  
5. All PRs **must be approved by at least one senior developer** before merge.  
6. Merges are performed **only by the lead maintainer**.  

> No direct pushes to `main` or other protected branches are allowed.

## Development Setup
1. Clone the repository:
```bash
git clone git@github.com:<organization>/<repo>.git
cd <repo>
```
2. Set up a local WordPress environment matching the production version.
3. Install dependencies:
```bash
composer install
npm install
```
4. Set up your IDE/editor to use linting and auto-formatting according to the project’s standards.

## Branching & Pull Requests
1. Branch naming convention:
```
feature/<feature-name>
fix/<issue-number>
hotfix/<description>
```
2. Branches must always be based on the latest main.
3. Pull Requests:
   * Base branch: main
   * Title: concise summary of the change
   * Description: detailed explanation, testing instructions, references to tasks/issues
   * Tag reviewers explicitly

## Coding Standards
We follow the WordPress Coding Standards for all code.

### PHP  
* Follow [WordPress PHP Coding Standards](https://developer.wordpress.org/coding-standards/)
* Inline documentation: Use PHPDoc blocks for functions, methods, classes; include `@since`, `@param`, `@return` tags.  
* Follow PSR‑12-ish structure while respecting WordPress flavour.
* Run `composer phpcs` before committing.

### JavaScript  
* Follow ES6+ syntax where possible, but ensure compatibility with WordPress target versions.  
* Use meaningful variable names.
* Lint with ESLint using the project configuration.
* Run `npm run check` before committing.

### CSS / SCSS  
* Follow WordPress CSS coding standards.
* Use lowercase names and hyphens for class names.  
* Avoid !important unless absolutely necessary.
* Run `npm run check` before committing.

## Code Review & Merging
* All PRs require approval from at least one senior developer.
* Merging is done only by the lead maintainer.
* No force pushes or direct commits to main.
* Automated checks must pass before merging (PHP CodeSniffer, ESLint, Stylelint, Unit tests & Code Coverage)

## Additional Resources
* [General GitHub documentation](http://help.github.com/)
* [GitHub pull request documentation](http://help.github.com/send-pull-requests/).
* [GitHub contributing to a project](https://docs.github.com/en/get-started/exploring-projects-on-github/contributing-to-a-project) for more in detail.
