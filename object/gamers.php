<?php

/**
 * Description of gamers
 *
 * @author https://roytuts.com
 */
class gamers
{

    // database connection and table nickname
    private $conn;
    private $table_nickname = "gamers";
    // object properties
    public $id;
    public $nikename;
    public $age;
    public $level;
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read gamerss
    function read()
    {
        // query to select all
        $query = "SELECT *
            FROM
                " . $this->gamers. "
            ORDER BY
            gamers.id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create gamers
    function create()
    {
        // query to insert record
        $query = "INSERT INTO
                " . $this->gamers . "
            SET
                dept_nickname=:nickname";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->nickname = htmlspecialchars(strip_tags($this->nickname));

        // bind values
        $stmt->bindParam(":nickname", $this->nickname);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // update the gamers
    function update()
    {
        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                dept_name = :name
            WHERE
                dept_id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nickname = htmlspecialchars(strip_tags($this->nickname));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':nickname', $this->nickname);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // delete the gamers
    function delete()
    {
        // delete query
        $query = "DELETE FROM " . $this->table_nickname . " WHERE dept_id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
