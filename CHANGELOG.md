# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Dockerfile for containerized testing environment with PHP 8.3 CLI and Xdebug support
- Automated test execution via Docker container
- GitHub Actions workflow updated to use modern versions (actions/cache@v4, actions/checkout@v4)
- Xdebug coverage mode configuration in CI

### Changed
- Updated Dockerfile base image from php:7.4-fpm to php:8.3-cli for better performance and security
- Modernized GitHub Actions workflow with latest action versions
- Improved test execution with proper XDEBUG_MODE environment variable setup

### Fixed
- Resolved deprecated `actions/cache@v2` warning by upgrading to v4
- Fixed coverage generation with explicit XDEBUG_MODE=coverage setting
- Streamlined Dockerfile for better caching and faster builds

## [Initial Release] - 2026-03-21

### Added
- PHP library for loading and calculating hotel prices
- PHPUnit test suite with JUnit XML logging
- Code analysis tools integration (phpstan, phpcs, phpmd, pdepend, phpmetrics)
- PSR-12 code style compliance checks
- Security checker for composer dependencies

### Features
- Load hotel price data from various sources
- Calculate prices based on dates and availability
- Comprehensive test coverage with JUnit reporting
- Static analysis tools for code quality assurance
- Multiple analysis reports (metrics, dependencies, code smells)
