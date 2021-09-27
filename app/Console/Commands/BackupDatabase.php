<?php

namespace App\Console\Commands;

use App\Models\BackupSetting;
use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup Database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mysqlHostName = env('DB_HOST');
        $mysqlUserName = env('DB_USERNAME');
        $mysqlPassword = env('DB_PASSWORD');
        $DbName = env('DB_DATABASE');
        $path = BackupSetting::find(1)->database_backup_path;

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file_name = $path . 'database_backup_on_' . date('YmdHis') . '.sql';

        $tables = [];
        $queryTables = \DB::select(\DB::raw('SHOW TABLES'));
        foreach ($queryTables as $table) {
            foreach ($table as $tName) {
                $tables[] = $tName;
            }
        }

        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword", array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();
        $output = '';
        foreach ($tables as $table) {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();

            foreach ($show_table_result as $show_table_row) {
                $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }

            $select_query = "SELECT * FROM " . $table;
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();
            for ($count = 0; $count < $total_row; $count++) {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);


                if ($count % 5000 == 0) {
                    $output .= ";\nINSERT INTO $table (`" . implode("`, `", $table_column_array) . "`) VALUES ";
                    $output .= "(";
                    $counter = 1;
                    $endOfCount = count($table_value_array);
                    foreach ($table_value_array as $value) {
                        $output .= $value == null ? "null" : "'" . str_replace("'", "\'", str_replace("\\", "/", $value)) . "'";
                        if ($counter != $endOfCount) $output .= ", ";
                        $counter++;
                    }
                    $output .= ")";
                } else {
                    $output .= ", (";
                    $counter = 1;
                    $endOfCount = count($table_value_array);
                    foreach ($table_value_array as $value) {
                        $output .= $value == null ? "null" : "'" . str_replace("'", "\'", str_replace("\\", "/", $value)) . "'";
                        if ($counter != $endOfCount) $output .= ", ";
                        $counter++;
                    }
                    $output .= ")";
                }

                if ($count == ($total_row - 1)) {
                    $output .= ";";
                }
            }
        }

        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
    }
}
