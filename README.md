<p align="center">
    <a href="https://github.com/laravel/laravel" target="_blank">
        <img src="https://camo.githubusercontent.com/5ceadc94fd40688144b193fd8ece2b805d79ca9b/68747470733a2f2f6c61726176656c2e636f6d2f6173736574732f696d672f636f6d706f6e656e74732f6c6f676f2d6c61726176656c2e737667" height="100px">
    </a>
    <h1 align="center">Organization Challenge</h1>
    <br>
</p>

<p align="center">
    <h3 align="center">HAPPY CODING :)</h3>
    <br>
</p>
# organization_challenge

#.gitignore:
 - node_modules
 - vendor
 
# plugin:
 - "dependencies": {
      - "yajra/laravel-datatables-oracle": "v8.13.5"  jQuery DataTables API for Laravel 4|5
      - "uxweb/sweet-alert": "2.0.1"    A simple PHP package to show Sweet Alerts with the Laravel Framework
    }

Note: you can run plugin depedencis with CMD with comment /path_app/npm update.

# Requirement App:
 - CRUD <full Eloquent>
 - Migration table Organization & Person
 - FormRequest validation patch: "Printerous\Http\Requests\..."
 - Unittest Organization & Person:
    * CRUD testing success
    * Controller testing success
    * FormRequest testing success
 - Datatables for list and function search
 - Alert
  
 Note: run Unittest .\vendor\bin\phpunit --debug OR .\vendor\bin\phpunit --debug --filter OrganizationTest <with name Unittest>
 
 # File Migration
 - \Printerous\database\migrations\2019_02_28_153633_organization.php
 - \Printerous\database\migrations\2019_03_05_152319_person.php
