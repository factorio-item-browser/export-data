![Factorio Item Browser](https://raw.githubusercontent.com/factorio-item-browser/documentation/master/asset/image/logo.png) 

# Export Data Library

[![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/factorio-item-browser/export-data)](https://github.com/factorio-item-browser/export-data/releases)
[![GitHub](https://img.shields.io/github/license/factorio-item-browser/export-data)](LICENSE.md)
[![build](https://img.shields.io/github/workflow/status/factorio-item-browser/export-data/CI?logo=github)](https://github.com/factorio-item-browser/export-data/actions)
[![Codecov](https://img.shields.io/codecov/c/gh/factorio-item-browser/export-data?logo=codecov)](https://codecov.io/gh/factorio-item-browser/export-data)

This library provides a data structure used to persist all the exported data from the Factorio game to the disk to later
upload it to the server and import it into the actual database. 

This persistence layer is required because the export gets executed on a local machine (able to run Factorio), which 
does not have access to the database on the server. This library simplifies uploading all the data (of which most are the 
icon images) and reading it into the importer script.  

The data itself is saved in a single JSON file. The library puts this file into a zip archive, and adds all the rendered
icon files to it as well, creating a single zip file as upload. All this is managed by the `ExportDataService`, which
is the main entry point for the library.
