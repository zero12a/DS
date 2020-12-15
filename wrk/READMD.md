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
    -t 스레드갯수
    -c 컨커런트갯수
    -d 실행시간(초)
    -s lua설정파일
