<?php
include '../db.php';

$sql = "SELECT 
    TABLE_NAME, 
    COLUMN_NAME, 
    CONSTRAINT_NAME,
    REFERENCED_TABLE_NAME,
    REFERENCED_COLUMN_NAME
FROM information_schema.KEY_COLUMN_USAGE 
WHERE REFERENCED_TABLE_NAME = 'registration' 
AND REFERENCED_TABLE_SCHEMA = 'orphanage_db'";

$result = mysqli_query($con, $sql);

echo "<h3>Foreign Keys referencing registration table:</h3>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "Table: " . $row['TABLE_NAME'] . " | Column: " . $row['COLUMN_NAME'] . "<br>";
}
mysqli_close($con);
?>