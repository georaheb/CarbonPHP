<?php
/**
 * Created by IntelliJ IDEA.
 * User: richardmiles
 * Date: 2/3/19
 * Time: 11:36 PM
 */

namespace CarbonPHP\Programs;


use CarbonPHP\Interfaces\iCommand;

class BuildDatabase implements iCommand
{
    use MySQL;

    public function usage() : void
    {
        print 'TODO - make a better command usage';
    }

    public function run($argv) : void
    {
        $argc = count($argv);


        for ($i=0;$i<$argc;$i++){
            switch($argv[$i]){
                case '-mysqldump':
                    $mysqldump = $argv[++$i];
                    break;
            }
        }

        $dump = file_get_contents($this->MySQLDump($mysqldump ?? null));

        if (!preg_match_all('#DROP TABLE IF EXISTS `(.+)`;([^-])+#', $dump, $matches)) {
            print 'No tables matched in MySQL Dump. It does not look like CarbonPHP is setup correctly. Run `>> php index.php setup` to fix this.' . PHP_EOL;
            exit(1);
        }

        $build = <<<TEXT
<?php
/**  This file is autogenerated, do not edit. Changes will be lost.
 * 
 * This script will safely build or rebuild you database
 * tables. You should never execute this script manually as
 * CarbonPHP will automatically rebuild itself if needed.
 *
 * regenerate this page with
 *
 *     php index.php buildBuildDatabase
 *
 */

print '<h1>Setting up CarbonPHP</h1>';

\$db = \CarbonPHP\Database::database();

try {
    print '<html><head><title>Setup or Rebuild Database</title></head><body><h1>STARTING MAJOR CARBON SYSTEMS</h1>' . PHP_EOL;

    \$head = <<<HEAD
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
HEAD;

    \$foot = <<<FOOT
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
FOOT;

TEXT;

        foreach ($matches[1] as $key => $tableName) {
            $build .= <<<TEXT
try {
        \$db->prepare('SELECT 1 FROM $tableName LIMIT 1;')->execute();
        print '<br>Table `$tableName` already exists</p>';
    } catch (PDOException \$e) {
        print '<br><p style="color: red">Creating `$tableName`</p>';
        \$sql = <<<END
        \$head
    {$matches[0][$key]}
        \$foot
END;

        print \$sql . '<br>';
        \$db->exec(\$sql) === false and die(print_r(\$db->errorInfo(), true));
        print '<br><p style="color: green">Table `$tableName` Created</p>';
    }
TEXT;
        }


        $tags = <<<TAGS
Try {
    \$sql = <<<END
REPLACE INTO tags (tag_id, tag_description, tag_name) VALUES (?,?,?);
END;
     \$tag = [
TAGS;

        foreach ($matches[1] as $key => $tableName) {
            $tags .= "['$tableName','','$tableName'],";
        }
        $tags .=  <<<TAGS
];
    foreach (\$tag as \$key => \$value) {
        \$db->prepare(\$sql)->execute(\$value);
    }
    print '<br>Tags inserted';

} catch (PDOException \$e) {
    print '<br>' . \$e->getMessage();
}

TAGS;

        $build .= $tags;

        $build .= <<<FOOT

    print '<br><br><h3>Rocking! CarbonPHP setup and/or rebuild is complete.</h3>';

} catch (PDOException \$e) {

    print 'Oh no, we failed to insert our databases!! Goto CarbonPHP.com for support and show the following code!<b>' . PHP_EOL;
    print \$e->getMessage() . PHP_EOL;

}
FOOT;

        if (!file_put_contents(APP_ROOT . 'config' . DS . 'buildDatabase.php', $build)) {
            print 'failed storing database build to file';
        }
    }
}