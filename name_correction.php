<?php
// Connect to MySQL
$servername = "localhost"; // Change this to your MySQL server address if it's not on the same machine
$username = "root";
$password = "";
$dbname = "people_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select full names that are repeated more than once from 'people_table'
$sql = "SELECT CONCAT(name, ' ', surname1, ' ', surname2) AS full_name, COUNT(*) AS count FROM people_table GROUP BY full_name HAVING count > 1";
$result = $conn->query($sql);

if ($result) {
    // Print full names that are repeated more than once
    echo "<h2>Repeated Full Names (More than Once):</h2>";
    while ($row = $result->fetch_assoc()) {
        $fullName = $row['full_name'];
        $count = $row['count'];
        echo "$fullName (Repeated $count times)<br>";
    }
} else {
    echo "Error retrieving repeated full names: " . $conn->error;
}

// Query to select and delete duplicate records based on full names from 'people_table'
$sql = "DELETE p1 FROM people_table p1
        INNER JOIN people_table p2 ON CONCAT(p1.name, ' ', p1.surname1, ' ', p1.surname2) = CONCAT(p2.name, ' ', p2.surname1, ' ', p2.surname2)
        WHERE p1.id < p2.id";

if ($conn->query($sql) === TRUE) {
    echo "Duplicate records deleted successfully";
} else {
    echo "Error deleting duplicate records: " . $conn->error;
}


$sql = "SELECT DISTINCT CONCAT(name, ' ', surname1, ' ', surname2) AS full_name FROM people_table ORDER BY full_name";
$result = $conn->query($sql);

if ($result) {
    
    $uniqueFullNames = array();

    
    while ($row = $result->fetch_assoc()) {
        $uniqueFullNames[] = $row['full_name'];
    }

    
    echo "<h2>Unique Full Names (Alphabetically):</h2>";
    foreach ($uniqueFullNames as $fullName) {
        echo "$fullName <br>";
    }

    
    $totalUniqueFullNames = count($uniqueFullNames);

    
    echo "<h3>Total Unique Full Names: $totalUniqueFullNames</h3>";
} else {
    echo "Error retrieving unique full names: " . $conn->error;
}



$nameCorrections = array(
    "Anna" => "Ana",
    "Bartolome" => "Bartholome",
    "Catalina" => "Cathalina",
    "jaime" => "jayme",
    "joan" => "Juan",
    "josef" => "joseph",
    "Joana" => "juana",
    "Margharita" => "Margarita",
    "Matheo" => "mateo",
    "Sebastiana" => "Sebastian"
);


$surname1Corrections = array(
    "Cantallops" => "Cantellops",
    "Coli" => "Coll",
    "Llompart" => "Llompard"
);


$surname2Corrections = array(
    "Llompart" => "Llompard"
);


$changesName = array();
$changesSurname1 = array();
$changesSurname2 = array();


function applyCorrections($corrections, $field, &$changesArray, $conn) {
    foreach ($corrections as $oldValue => $newValue) {
        $sql = "UPDATE people_table SET $field = '$newValue' WHERE $field = '$oldValue'";
        $result = $conn->query($sql);

        if ($result) {
            $changesArray[] = "Changed $field '$oldValue' to '$newValue'";
        } else {
            $changesArray[] = "Error changing $field '$oldValue': " . $conn->error;
        }
    }
}

// Perform name corrections
applyCorrections($nameCorrections, 'name', $changesName, $conn);

// Perform surname1 corrections
applyCorrections($surname1Corrections, 'surname1', $changesSurname1, $conn);

// Perform surname2 corrections
applyCorrections($surname2Corrections, 'surname2', $changesSurname2, $conn);

// Print changes
echo "<h2>Changes:</h2>";
echo "<h3>Name Changes:</h3>";
foreach ($changesName as $change) {
    echo "$change <br>";
}

echo "<h3>Surname1 Changes:</h3>";
foreach ($changesSurname1 as $change) {
    echo "$change <br>";
}

echo "<h3>Surname2 Changes:</h3>";
foreach ($changesSurname2 as $change) {
    echo "$change <br>";
}


// Close the database connection
$conn->close();
?>
