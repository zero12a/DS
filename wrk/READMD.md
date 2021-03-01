1.wrk 로컬 점검시 결과에 아래와 같이 "connect 에러가 많은 경우"
  - wrk 결과 : Socket errors: connect 5, read 0, write 0, timeout 0
  - 파일리밋 조회 : ulimit -n  (보통 256임)
  - 파일리밋 늘리기 (  https://gist.github.com/skylock/0117ec637d468f91260927b43b816eda )
    1. root 계정을 활성화하고
    2. root 계정으로 접속해서 max늘리기


2. 예시
  >  wrk -t 10 -c 10 -d 10s -s post1.lua http://localhost:8090/c.g/bo_main_v3.php
  >  wrk -t 10 -c 10 -d 10s -s get1.lua http://localhost:8090/c.g/bo_main_v3.php
  >  wrk -t 10 -c 10 -d 10s -s post1.lua http://localhost:8052/newToken/?req_token=9bba4f5b-b3f8-4e78-89b2-ab84503bb79b
  >  wrk -t 10 -c 10 -d 10s -s post1.lua http://localhost:18052/o.s/os2ctl.php?req_token=9bba4f5b-b3f8-4e78-89b2-ab84503bb79b
    -t 스레드갯수
    -c 컨커런트갯수
    -d 실행시간(초)
    -s lua설정파일

  > wrk -t 10 -c 10 -d 10s -s workerman.lua http://localhost:9081/
  > wrk -t 10 -c 10 -d 10s -s swoole.lua http://localhost:9082/
  > wrk -t 10 -c 10 -d 10s -s phpfpm.lua http://localhost:9080/d.s/demo_perf_phpfpm.php


3. 결과
YOUNGui-Air:wrk zeroone$ wrk -t 20 -c 20 -d 20s -s swoole.lua http://localhost:9082/
Running 20s test @ http://localhost:9082/
  20 threads and 20 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency    98.24ms  121.00ms   1.17s    95.30%
    Req/Sec    13.11      5.99    40.00     68.65%
  3400 requests in 20.11s, 58.30MB read
  Socket errors: connect 6, read 0, write 0, timeout 0
Requests/sec:    169.09
Transfer/sec:      2.90MB
Response count: 0
YOUNGui-Air:wrk zeroone$ wrk -t 20 -c 20 -d 20s -s swoole.lua http://localhost:9082/
Running 20s test @ http://localhost:9082/
  20 threads and 20 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency    66.44ms   26.83ms 280.98ms   76.30%
    Req/Sec    15.14      5.98    40.00     76.18%
  3927 requests in 20.10s, 67.34MB read
  Socket errors: connect 7, read 0, write 0, timeout 0
Requests/sec:    195.39
Transfer/sec:      3.35MB
Response count: 0
YOUNGui-Air:wrk zeroone$ 
YOUNGui-Air:wrk zeroone$ 
YOUNGui-Air:wrk zeroone$ 
YOUNGui-Air:wrk zeroone$ wrk -t 20 -c 20 -d 20s -s workerman.lua http://localhost:9081/
Running 20s test @ http://localhost:9081/
  20 threads and 20 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency    83.48ms   69.06ms 966.11ms   90.83%
    Req/Sec    14.11      7.62    40.00     78.20%
  3313 requests in 20.10s, 56.70MB read
  Socket errors: connect 7, read 0, write 0, timeout 0
Requests/sec:    164.83
Transfer/sec:      2.82MB
Response count: 0
YOUNGui-Air:wrk zeroone$ 
YOUNGui-Air:wrk zeroone$ 
YOUNGui-Air:wrk zeroone$ wrk -t 20 -c 20 -d 20s -s workerman.lua http://localhost:9081/
Running 20s test @ http://localhost:9081/
  20 threads and 20 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency   103.04ms  127.46ms   1.17s    96.05%
    Req/Sec    13.01      7.56    40.00     73.21%
  3200 requests in 20.09s, 54.77MB read
  Socket errors: connect 6, read 0, write 0, timeout 0
Requests/sec:    159.27
Transfer/sec:      2.73MB
Response count: 0
YOUNGui-Air:wrk zeroone$ wrk -t 10 -c 10 -d 10s -s phpfpm.lua http://localhost:9080/d.s/demo_perf_phpfpm.php
Running 10s test @ http://localhost:9080/d.s/demo_perf_phpfpm.php
  10 threads and 10 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency    66.81ms   26.92ms 228.02ms   80.00%
    Req/Sec    15.16      6.01    30.00     76.20%
  1058 requests in 10.09s, 18.42MB read
  Socket errors: connect 3, read 0, write 0, timeout 0
Requests/sec:    104.82
Transfer/sec:      1.82MB
Response count: 0
YOUNGui-Air:wrk zeroone$ 
YOUNGui-Air:wrk zeroone$ 
YOUNGui-Air:wrk zeroone$ wrk -t 10 -c 10 -d 10s -s phpfpm.lua http://localhost:9080/d.s/demo_perf_phpfpm.php
Running 10s test @ http://localhost:9080/d.s/demo_perf_phpfpm.php
  10 threads and 10 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency    60.05ms   20.19ms 242.70ms   81.80%
    Req/Sec    16.67      5.73    30.00     60.46%
  1347 requests in 10.09s, 23.45MB read
  Socket errors: connect 2, read 0, write 0, timeout 0
Requests/sec:    133.44
Transfer/sec:      2.32MB
Response count: 0
YOUNGui-Air:wrk zeroone$ wrk -t 20 -c 20 -d 20s -s phpfpm.lua http://localhost:9080/d.s/demo_perf_phpfpm.php
Running 20s test @ http://localhost:9080/d.s/demo_perf_phpfpm.php
  20 threads and 20 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency   183.82ms  191.65ms   1.30s    92.44%
    Req/Sec     7.94      3.33    20.00     73.09%
  1808 requests in 20.09s, 31.47MB read
  Socket errors: connect 6, read 0, write 0, timeout 0
Requests/sec:     89.99
Transfer/sec:      1.57MB
Response count: 0
YOUNGui-Air:wrk zeroone$ 
YOUNGui-Air:wrk zeroone$ wrk -t 20 -c 20 -d 20s -s phpfpm.lua http://localhost:9080/d.s/demo_perf_phpfpm.php
Running 20s test @ http://localhost:9080/d.s/demo_perf_phpfpm.php
  20 threads and 20 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency   135.34ms  159.79ms   1.17s    94.42%
    Req/Sec    10.15      3.79    20.00     79.86%
  2360 requests in 20.10s, 41.09MB read
  Socket errors: connect 7, read 0, write 0, timeout 0
Requests/sec:    117.41
Transfer/sec:      2.04MB
Response count: 0
YOUNGui-Air:wrk zeroone$ 
