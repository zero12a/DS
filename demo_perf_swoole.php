<?php 
//테스트 버전 : swoole 4.6.4
// pecl install swoole && docker-php-ext-enable swoole 
require_once "/data/www/lib/php/vendor/autoload.php";
require_once "./demo_perf_swoole_class.php";

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;

$server = new Swoole\HTTP\Server("0.0.0.0", 82);
$server->set([
    'worker_num' => 4
    //,'max_conn' => 300
    //,'max_request' => 100
]);

$server->on("start", function (Server $server) {
    echo "Swoole http server is started at http://0.0.0.0:82\n";
});

$reqCnt = 0;

$server->on("request", function (Request $request, Response $response)use(&$reqCnt){
    $response->header("Content-Type", "text/plain");
    $reqCnt++;
    echo "reqCnt = " . $reqCnt . PHP_EOL;

    $dbObj = new dbClass();
    $tarr = $dbObj->getSingleQuery();

    $response->end(json_encode($tarr));
});

$server->start();

?>