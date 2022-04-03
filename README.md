# DataEngineeringHelper

## Database utilities

These database utilities are not ready to handle SQL Injection, so they should only be used in controlled environments.

getArrayFromDatabase($host, $database, $username, $password, $sql)
- Receives database connection information and an SQL query.
- Returns an array of database rows that result from executing the SQL query.

Example usage:
```
$user = "macgyver";
$pass = "mr-t-eats-bananas";
$database = "university";
$query = "select * from student";
$dbRows = getArrayFromDatabase("localhost", $database, $user, $pass, $query);
print_r($dbRows);
```

## CSV utilities

readArrayFromCSV($filename, $ignore_first_line = true)
- reads a CSV file into an array
- The argument $ignore_first_line should be used when the first line of the file is a header that should not be included in the array.

writeArrayToCSV($array, $filename, $header, $separator = ",")
- Receives an array, the target CSV's filename and header, and an optional $separator which defaults to ",".
- Writes the array's contents to a file

Example usage:
```
$people = array(array("id" => 1, "name" => "bc"), array("id" => 2, "name" => "rcc"));
$header = "ID,NAME";
writeArrayToCSV($people, "people.csv", $header);
```

## JSON utilities
