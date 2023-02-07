<?php
/*
 * @Author jacobitkashala <jacobitkashala@gmail.com>
 * @Version 1.0
 * @Package Database
 */

define('DOMAIN_URL', 'https://nom_domain.com/');
define('path_media', ''); /* chnage to your domain here - don't forget to add forward slash at the end of the URL like this "/" */

class Database
{
    /* 
     * Create variables for credentials to MySQL database
     * The variables have been declared as private. This
     * means that they will only be available with the 
     * Database class
     */
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "wcg_site_web_databases";


    /*
     * Extra variables that are required by other function such as boolean con variable
     */
    private $con = false; // Check to see if the connection is active
    //define PDO object
    private $pdo;
    private $result = array(); // Any results from a query will be stored here
    private $myQuery = ""; // used for debugging process with SQL return
    private $numResults = ""; // used for returning the number of rows

    // Function to make connection to database
    public function connect()
    {
        try {
            if (!$this->con) {
                $this->pdo = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $this->pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
                $this->con = true;

                if ($this->con) {
                    return true; // Connection has been made return TRUE
                } else {
                    return false; // Connection has not been made return FALSE
                }
            } else {
                return true; // Connection has already been made return TRUE 
            }
        } catch (Exception $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    // Function to disconnect from the database
    public function disconnect()
    {
        // If there is a PDO object, close the connection
        if ($this->con) {
            if ($this->pdo != null) {
                $this->pdo = null;
            }
            $this->con = false; // Set the connection to false
            return true;
        }
    }

    public function sql($sql) {
        $query = $this->pdo->prepare($sql);
        $this->myQuery = $sql;
        if ($query) {
            // If the query returns >= 1 assign the number of rows to numResults
            $this->numResults = 0;
            //if there is a result and the result is greater than 0
            if ($query->execute()) {
                $this->numResults = $query->rowCount();
            }
            /* 
            if (isset($query->num_rows) && ($query->num_rows > 0)) {
                $this->numResults = $query->num_rows;
            } */
            // Loop through the query results by the number of rows returned
            for ($i = 0; $i < $this->numResults; $i++) {
                $r = $query->fetch(PDO::FETCH_ASSOC);
                $key = array_keys($r);
                for ($x = 0; $x < count($key); $x++) {
                    if (!is_int($key[$x])) {
                        if ($query->rowCount() > 1) {
                            $this->result[$i][$key[$x]] = $r[$key[$x]];
                        } else {
                            $this->result = null;
                        }
                    }
                }
            }
            return true; // Query was successful
        } else {
            array_push($this->result, $this->pdo->errorInfo());
            return false; // No rows where returned
        }
    }

    // Function to SELECT from the database
    public function select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null)
    {
        // Create query from the variables passed to the function
        $q = 'SELECT ' . $rows . ' FROM ' . $table;
        // echo $q;
        if ($join != null) {
            $q .= ' JOIN ' . $join;
        }
        if ($where != null) {
            $q .= ' WHERE ' . $where;
        }
        if ($order != null) {
            $q .= ' ORDER BY ' . $order;
        }
        if ($limit != null) {
            $q .= ' LIMIT ' . $limit;
        }
        // echo $table;
        $this->myQuery = $q; // Pass back the SQL
        // Check to see if the table exists
        if ($this->tableExists($table)) {
            // The table exists, run the query
            $query = $this->pdo->query($q);
            if ($query) {
                // If the query returns >= 1 assign the number of rows to numResults
                $this->numResults = $query->rowCount();
                // Loop through the query results by the number of rows returned
                for ($i = 0; $i < $this->numResults; $i++) {
                    $r = $query->fetch(PDO::FETCH_ASSOC);
                    $key = array_keys($r);
                    for ($x = 0; $x < count($key); $x++) {
                        // Sanitizes keys so only alphavalues are allowed
                        if (!is_int($key[$x])) {
                            if ($query->rowCount() > 1) {
                                $this->result[$i][$key[$x]] = $r[$key[$x]];
                            } else {
                                $this->result[$i][$key[$x]] = null;
                            }
                        }
                    }
                }
                return true; // Query was successful
            } else {
                array_push($this->result, $this->pdo->errorInfo());
                return false; // No rows where returned
            }
        } else {
            return false; // Table does not exist
        }
    }

    // Function to insert into the database
    public function insert($table, $params = array())
    {
        // Check to see if the table exists
        if ($this->tableExists($table)) {
            $sql = 'INSERT INTO `' . $table . '` (`' . implode('`, `', array_keys($params)) . '`) VALUES ("' . implode('", "', $params) . '")';
            // echo $sql;
            $this->myQuery = $sql; // Pass back the SQL
            // Make the query to insert to the database
            if ($ins = $this->pdo->query($sql)) {
                array_push($this->result, $this->pdo->lastInsertId());
                // print_r($this->result);
                return true; // The data has been inserted
            } else {
                array_push($this->result, $this->pdo->errorInfo());
                return false; // The data has not been inserted
            }
        } else {
            return false; // Table does not exist
        }
    }

    //Function to delete table or row(s) from database
    public function delete($table, $where = null){
        // Check to see if table exists
        if ($this->tableExists($table)) {
            // The table exists check to see if we are deleting rows or table
            if ($where == null) {
                $delete = 'DROP TABLE ' . $table; // Create query to delete table
            } else {
                $delete = 'DELETE FROM ' . $table . ' WHERE ' . $where;
                // echo $sql;// Create query to delete rows
            }
            // Submit query to database
            if ($del = $this->pdo->query($delete)) {
                array_push($this->result, $this->pdo->affected_rows);
                $this->myQuery = $delete; // Pass back the SQL
                return true; // The query exectued correctly
            } else {
                array_push($this->result, $this->pdo->error);
                return false; // The query did not execute correctly
            }
        } else {
            return false; // The table does not exist
        }
    }

    // Function to update row in database
    public function update($table, $params = array(), $where)
    {
        // Check to see if table exists
        if ($this->tableExists($table)) {
            // Create Array to hold all the columns to update
            $args = array();
            foreach ($params as $field => $value) {
                // Seperate each column out with it's corresponding value
                $args[] = $field . '="' . $value . '"';
            }
            // Create the query
            $sql = 'UPDATE ' . $table . ' SET ' . implode(',', $args) . ' WHERE ' . $where;
            // echo $sql;
            // Make query to database
            $this->myQuery = $sql; // Pass back the SQL
            if ($query = $this->pdo->query($sql)) {
                array_push($this->result, $this->pdo->affected_rows);
                return true; // Update has been successful
            } else {
                array_push($this->result, $this->pdo->error);
                return false; // Update has not been successful
            }
        } else {
            return false; // The table does not exist
        }
    }

    // Private function to check if table exists for use with queries
    private function tableExists($table)
    {
        $tablesInDb = $this->pdo->query('SHOW TABLES FROM `' . $this->db_name . '` LIKE "' . $table . '"');
        if ($tablesInDb) {
            if ($tablesInDb->num_rows == 1) {
                return true; // The table exists
            } else {
                array_push($this->result, $table . " does not exist in this database");
                return false; // The table does not exist
            }
        }
    }

    // Public function to return the data to the user
    public function getResult() {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    //Pass the SQL back for debugging
    public function getSql() {
        $val = $this->myQuery;
        $this->myQuery = array();
        return $val;
    }

    //Pass the number of rows back
    public function numRows(){
        $val = $this->numResults;
        $this->numResults = array();
        return $val;
    }

    // Escape your string
    public function escapeString($data){
        return $this->pdo->real_escape_string($data);
    }
}
