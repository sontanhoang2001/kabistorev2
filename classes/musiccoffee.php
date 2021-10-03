<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class musiccoffee
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getMusic()
    {
        $query = "SELECT * FROM tbl_music WHERE enable = 1 ORDER BY rank ASC";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        } else {
            return "Lỗi hệ thống bài hát!";
        }
    }
}
?>