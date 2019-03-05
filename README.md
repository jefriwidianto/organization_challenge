# organization_challenge

#.gitignore:
 - node_modules
 - vendor
 
# plugin:
 - "dependencies": {
      "yajra/laravel-datatables-oracle": "v8.13.5"  jQuery DataTables API for Laravel 4|5
      "uxweb/sweet-alert": "2.0.1"    A simple PHP package to show Sweet Alerts with the Laravel Framework
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
