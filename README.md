# Factorio Item Browser - Export Data

[![Latest Stable Version](https://poser.pugx.org/factorio-item-browser/export-data/v/stable)](https://packagist.org/packages/factorio-item-browser/export-data)
[![License](https://poser.pugx.org/factorio-item-browser/export-data/license)](https://packagist.org/packages/factorio-item-browser/export-data)
[![Build Status](https://travis-ci.com/factorio-item-browser/export-data.svg?branch=master)](https://travis-ci.com/factorio-item-browser/export-data)
[![codecov](https://codecov.io/gh/factorio-item-browser/export-data/branch/master/graph/badge.svg)](https://codecov.io/gh/factorio-item-browser/export-data)

This library provides a data structure used to persist all the exported data from the Factorio game to the disk to later
upload it to the server and import it into the actual database. 

This persistence layer is required because the export gets executed on a local machine (able to run Factorio), which 
does not have access to the database on the server. This library simplifies uploading all the data (of which most are the 
icon images) and reading it into the importer script.  

The data itself is saved in a single JSON file. The library puts this file into a zip archive, and adds all the rendered
icon files to it as well, creating a single zip file as upload. All this is managed by the `ExportDataService`, which
is the main entry point for the library.
