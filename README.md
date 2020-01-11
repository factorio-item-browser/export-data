# Factorio Item Browser - Export Data

[![Latest Stable Version](https://poser.pugx.org/factorio-item-browser/export-data/v/stable)](https://packagist.org/packages/factorio-item-browser/export-data)
[![License](https://poser.pugx.org/factorio-item-browser/export-data/license)](https://packagist.org/packages/factorio-item-browser/export-data)
[![Build Status](https://travis-ci.com/factorio-item-browser/export-data.svg?branch=master)](https://travis-ci.com/factorio-item-browser/export-data)
[![codecov](https://codecov.io/gh/factorio-item-browser/export-data/branch/master/graph/badge.svg)](https://codecov.io/gh/factorio-item-browser/export-data)

This small library provides a data format used for temporarily persisting the exported data from the Factorio game to
the disk to later import it into the actual database.

This persistence step is required because the export is executed on a local machine (able to run Factorio), which is 
not able to directly access the database. The files created by this library can be easily uploaded to the server and
loaded by the importing script.

The data is organized in registries and referenced by hashes. If e.g. two mods define the same recipe (same ingredients,
recipes etc.) then the recipe data is saved only once and referenced from both mods. All registries are accessible 
through the `ExportDataService` instance.

## Usage

To save or load any data, the `ExportDataService` is used. Upon creation an adapter must be specified to actually 
persist the data.

The following adapter are available:

- **FileSystemAdapter**: This adapter stores the data in a directory on the server. The writable base directory must be
  specified in the constructor, and the adapter will manage the directory structure on its own.
- **VoidAdapter**: This adapter voids any data and will actually not persist it.
