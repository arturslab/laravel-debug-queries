# laravel-debug-queries
This simple snippet allow you dump DB queries. This snippet is uselful in development environment if you run Laravel commands from console and you have some database queries that you want check. All queries are printed in console with those informations:
- BINDINGS
- FULL QUERY STRING
- QUERY EXECUTION TIME
- CONNECTION NAME

## Usage
Add **debugQueries** method from **SampleCommand.php** file into your command class and insert code `$this->debugQueries();` into commands handle method body.