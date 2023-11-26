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


set_time_limit(10);

// Load XML file
$xmlFile = "AllPeople.xml";
$xml = simplexml_load_file($xmlFile);

// Count total persons
$totalPersons = count($xml->person);

// Display the total number of persons
echo "<h1>Total Persons: $totalPersons</h1>";


// Loop through each person in the XML file and insert into the database
foreach ($xml->person as $person) {
    $sql = "INSERT INTO people_table (gender, name, alter_name, surname1, surname2, birth, father_name, father_surname1, father_surname2, mother_name, mother_surname1, mother_surname2, father_grandfather_name, father_grandmother_name, mother_grandfather_name, mother_grandmother_name)
    VALUES (
        '" . $person->gender . "',
        '" . $person->name . "',
        '" . $person->alter . "',
        '" . $person->surname1 . "',
        '" . $person->surname2 . "',
        '" . $person->birth . "',
        '" . $person->fathername . "',
        '" . $person->fathersurname1 . "',
        '" . $person->fathersurname2 . "',
        '" . $person->mothername . "',
        '" . $person->mothersurname1 . "',
        '" . $person->mothersurname2 . "',
        '" . $person->father_grandfathername . "',
        '" . $person->father_grandmothername . "',
        '" . $person->mother_grandfathername . "',
        '" . $person->mother_grandmothername . "'
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully\n";
    } else {
        echo "Error inserting record: " . $conn->error . "\n";
    }
}

// Close the database connection
$conn->close();
?>
