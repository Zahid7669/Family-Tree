-- Create 'child' table
CREATE TABLE IF NOT EXISTS child (
    child_id INT AUTO_INCREMENT PRIMARY KEY,
    child_name VARCHAR(255),
    child_surname1 VARCHAR(255),
    child_surname2 VARCHAR(255),
    child_birth VARCHAR(255),
    parent_id INT,
    FOREIGN KEY (parent_id) REFERENCES parent(parent_id)
);

-- Create 'parent' table
CREATE TABLE IF NOT EXISTS parent (
    parent_id INT AUTO_INCREMENT PRIMARY KEY,
    father_name VARCHAR(255),
    father_surname1 VARCHAR(255),
    father_surname2 VARCHAR(255),
    mother_name VARCHAR(255),
    mother_surname1 VARCHAR(255),
    mother_surname2 VARCHAR(255)
);