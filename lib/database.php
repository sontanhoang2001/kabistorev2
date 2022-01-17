<?php
$filepath = realpath(dirname(__FILE__));
include($filepath . '/../config/config.php'); ?>
<?php
$host   = DB_HOST;
$user   = DB_USER;
$pass   = DB_PASS;
$dbname = DB_NAME;

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

class Database extends PDO
{
  public $host   = DB_HOST;
  public $user   = DB_USER;
  public $pass   = DB_PASS;
  public $dbname = DB_NAME;

  public $link;
  public $error;

  public function __construct()
  {
    $this->connectDB();
  }

  private function connectDB()
  {
    $this->link = new mysqli(
      $this->host,
      $this->user,
      $this->pass,
      $this->dbname
    );

    mysqli_set_charset($this->link, "utf8");

    if (!$this->link) {
      $this->error = "Connection fail" . $this->link->connect_error;
      return false;
    }
  }

  // Select or Read data
  public function select($query)
  {
    $result = $this->link->query($query) or
      die($this->link->error . __LINE__);
    if ($result->num_rows > 0) {
      return $result;
    } else {
      return false;
    }
    $this->link = null;
  }

  // Insert data
  public function insert($query)
  {
    $insert_row = $this->link->query($query);
    if ($insert_row) {
      return $insert_row;
    } else {
      return false;
    }
    $this->link = null;
    //return $this->link->error;
  }

  // Update data
  public function update($query)
  {
    $update_row = $this->link->query($query);
    if ($update_row) {
      return $update_row;
    } else {
      return false;
    }
    $this->link = null;
  }

  // Delete data
  public function delete($query)
  {
    $delete_row = $this->link->query($query);
    if ($delete_row) {
      return $delete_row;
    } else {
      return false;
    }
    $this->link = null;
  }
}
