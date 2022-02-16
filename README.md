"# DataEngineeringHelper" 

## Database utilities

getArrayFromDatabase($host, $database, $username, $password, $sql)
- Receives database connection information and an SQL query.
- Returns an array of database rows that result from executing the SQL query.

Example usage:

## CSV utilities

writeArrayToCSV($array, $)
- Receives an array, the target CSV's filename and header, and an optional $separator which defaults to ",".
- Writes the array's contents to a file

Example usage:
$people = array(array("id" => 1, "name" => "bc"));
writeArrayToCSV($people, "people.csv", "ID,NAME");