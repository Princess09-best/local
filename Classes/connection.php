<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "ashesigram_db";

    function connect()
    {
        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $connection;
    }

    function read($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error executing query: " . mysqli_error($conn));
        }

        $data = array(); // Initialize an empty array to store data
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        // Free result set
        mysqli_free_result($result);

        // Close connection
        mysqli_close($conn);

        return $data;
    }

    function save($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error executing query: " . mysqli_error($conn));
        }

        // Close connection
        mysqli_close($conn);

        return true;
    }
}

?>

    
?>