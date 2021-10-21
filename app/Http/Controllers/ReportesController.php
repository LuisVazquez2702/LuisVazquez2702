<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPJasper\PHPJasper;

class ReportesController extends Controller
{
    public function reporteItem(){


        $input = base_path() .  '/vendor/geekcom/phpjasper-laravel/examples/ReporteWeb.jasper';
        $output = base_path() .  '/vendor/geekcom/phpjasper-laravel/examples/';
        $jdbc = base_path() . '/vendor/geekcom/phpjasper-laravel/bin/jasperstarter/jdbc';
        $options = [
            'format' => ['pdf', 'csv'],
            'db_connection' => [
                'driver' => 'generic',
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'host' => env('DB_HOST'),
                'database' => env('DB_DATABASE'),
                'port' => env('DB_PORT'),
                'jdbc_driver' => 'com.microsoft.sqlserver.jdbc.SQLServerDriver',
                'jdbc_url' => 'jdbc:sqlserver://127.0.0.1:' . env('DB_PORT') . ';databaseName=' . env('DB_DATABASE'),
                'jdbc_dir' => $jdbc
            ]
        ];


        $jasper = new PHPJasper;

        $jasper->process(
                $input,
                $output,
                $options
        )->execute();

        return response()->file($output . "ReporteWeb.pdf");
    }
    public function compilarItem(){

        //$input = __DIR__ . '/vendor/geekcom/phpjasper/examples/hello_world.jrxml';
        $input = 'C:\Users\Temp\JaspersoftWorkspace\MyReports\ReporteWeb.jrxml';

        $jasper = new PHPJasper;
        $jasper->compile($input)->execute();
        return "Ya esta";
    }
}
