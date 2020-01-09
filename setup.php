<?php

if (file_exists("Install.php")) {
    require_once "Install.php";
    $install = new Install();
}

if (isset($_POST['install'])) {
    $db_name = $install->realEscapeHtml($_POST['db_name']);
    $local_host = $install->realEscapeHtml($_POST['localhost']);
    $local_user = $install->realEscapeHtml($_POST['local_user']);
    $local_pass = $install->realEscapeHtml($_POST['local_pass']);
    $port = $install->realEscapeHtml($_POST['mysql_port']);
    try {
        require_once "db_create.php";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $conn = new PDO("mysql:host=$local_host", $local_user, $local_pass,$options);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS $db_name DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;";
        $conn->exec($sql);
        $sql = "use $db_name";
        $conn->exec($sql);
        $tables = [$table1,$table2,$table3,$table4,$table5,$table6,$table7,$table8];
        $alters = [$alter1,$alter2,$alter3,$alter4,$alter5,$alter6,$alter7,$alter8,$alter9,$alter10,$alter11,$alter12,$alter13,$alter14,$alter15,$alter16,$alter17,$alter18,$alter19];
        $inserts = [$insert1,$insert2,$insert3,$insert4,$insert6,$insert5];
        for ($x=0; $x < count($tables); $x++) {
            $sql = $tables[$x];
            $conn->exec($sql);
        }
        for ($x=0; $x < count($inserts); $x++) {
            $sql = $inserts[$x];
            $conn->exec($sql);
        }
        for ($x=0; $x < count($alters); $x++) {
            $sql = $alters[$x];
            $p = $conn->exec($sql);
        }

            if ($p) {
                unlink("config.php");
                touch('config.php');
                chmod('config.php', 0777);
                $setting = fopen("config.php","wa+");
                $text = "<?php\n\n";
                fwrite($setting,$text);
                $text = "define('HOST','$local_host');\n";
                fwrite($setting,$text);
                $text = "define('DB','$db_name');\n";
                fwrite($setting,$text);
                $text = "define('USER','$local_user');\n";
                fwrite($setting,$text);
                $text = "define('PASS','$local_pass');\n";
                fwrite($setting,$text);
                $text = "define('PORT',$port);\n";
                fwrite($setting,$text);
                $text = "define('CHARSET','utf8');\n";
                fwrite($setting,$text);
                $text = "define('OPTIONS',[
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ".'"utf8"'."',
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);\n";
                fwrite($setting,$text);
                fclose($setting);
            }
            if (file_exists("config.php")) {
                    unlink("installation.php");
                    unlink("db_create.php");
                    unlink("Install.php");
                function internalUrl($arg) {

                        $search = ['/opt/lampp/htdocs',$arg];
                        $replace = [''];
                        return str_replace($search,$replace,__DIR__);


                }
                function redirectMethod($url) {
                        header("Location:".$url."?response=3518dd49797b36ddee688388cff644db");

                }
                redirectMethod(internalUrl('localhost/help_desk'));
            }

    }
    catch(PDOException $e)
    {
        $e->getMessage();
    }
    $conn = null;
}
