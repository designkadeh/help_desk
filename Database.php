<?php
require_once "config.php";
class Database extends PDO
{
    private $host = HOST;
    private $db = DB;
    private $user = USER;
    private $password = PASS;
    private $port = PORT;
    private $charset = CHARSET;
    private $options = OPTIONS;
    private $error;
    private $dbh;
    private $isConnect;
    public function __construct()
    {

        try {
            $this->dbh = new PDO(
                'mysql:host='.$this->host.
                ';dbname='.$this->db.
                ';port='.$this->port.
                ';charset='.$this->charset,
                $this->user,
                $this->password,
                $this->options
            );
            $this->isConnect = true;
        }
        catch (PDOException $e) {
            $this->error = 'Can not Connect to db';
        }
    }
    public function dicConnect () {
        $this->isConnect = false;
        $this->dbh = null;
    }
    public function curdMethod($query,$params=[]) {
        //Insert,Update,Delete,Register
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->execute($params);
            return true;
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
        return false;
    }
    public function loginMethod($table,$u,$p,$username,$password) {
        try {
            $query = "SELECT * FROM $table WHERE $u = ? AND $p = ?";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(1,$username);
            $stmt->bindParam(2,$password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
        return false;
    }
    public function logout(array $arg) {
        try {
            session_start();
            $_SESSION[$arg] = null;
            session_destroy();
            session_unset();
            $this->redirectMethod('index.php');
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
    public function searchMethod($table,$s,$search) {
        try {
            $query = 'SELECT * FROM '.$table.' WHERE '.$s.' LIKE "%'.$search.'%" ' ;
            $stmt = $this->dbh->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
    public function redirectMethod($url) {
        try {
            header("Location:".$url);
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
    private function htmlSpecialChars($arg) {
        try {
            $search = ['<','>','&lt','&gt','&#60;','&#62;'];
            return str_replace($search,'',$arg);
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
    public function realEscapeHtml($arg) {
        try {
            $result = trim($this->htmlSpecialChars(stripcslashes($arg)));
            return $result;
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
        return false;
    }
    public function securityMethod($password) {
        try {
            $result = md5(sha1($password.md5("h@@-NTG!")).sha1("%256G3@L)=^")."145$#slah");
            return $result;
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
        return false;

    }
    public function getRows($j,$table, $where, $w) {
        try {
            $query = "SELECT $j FROM $table WHERE $where = '".$w."' ";
            $stmt = $this->dbh->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
        return false;
    }
    public function multipleJoinMethod($j,$table,$joinOne, $tableJoin, $joinTable,$joinTwo, $tableTwoJoin, $joinTwoTable,$joinThree,$tableThreeJoin,$joinThreeTable) {
        try {
            $query = "SELECT $j FROM $table JOIN $joinOne ON $tableJoin = $joinTable JOIN $joinTwo ON $tableTwoJoin = $joinTwoTable JOIN $joinThree ON $tableThreeJoin = $joinThreeTable";
            $stmt = $this->dbh->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
        return false;
    }
    public function internalUrl($arg) {
        try {
            $search = ['/opt/lampp/htdocs',$arg];
            $replace = [''];
            return str_replace($search,$replace,__DIR__);
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
        return false;
    }
}