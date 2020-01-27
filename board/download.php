<?php

    $srcName = $_GET['src_name']; //원본파일명
    $filePath = $_GET['file_path']; //저장된 파일경로 및 파일명
    $fileSize = $_GET['file_size']; //파일 사이즈

    //저장된 파일을 사용자에게 byte단위로 echo시킨다고 생각하면 됨.
    //byte단위로 echo시키면 그것이 다운로드 동작임
    
    // 그러기 위해서 저장된 파일을 읽어와야함. 

    //file_exists() 내장함수  
    if(file_exists($filePath)){
        //파일을 바이트 단위로 읽기 위한 파일포인터 얻어오기
        $fp = fopen($filePath,"rb"); //fp = file point, fopen = file open, r = read mode w=write mode , rb = read binary 이진수를 읽겠다.

    //다운로드받을 사용자에게 파일에 대한 metadata(메타데이터)를 
    //헤더로 추가해서 보내줘야만 다운로드가 가능함. 

        Header("Content-Type:application/x-msdownload");//application을 보낸다.
        Header("Content-Length: ".$fileSize);//파일사이즈
        Header("Content-Disposition: attachment; filename=.$srcName"); //파일 첨부; filename= 은 사용자의 브라우저에 보여지는 파일명
        Header("Content-Transfer-Encoding: binary");//전송인코딩 방식 : 바이너리
        Header("Content-Description: File Transfer"); //콘텐츠의 세부 행동이 파일 전송이다.
        Header("Expires: 0");

    
    }

    // fpassthru(); //file pass through 사용자에게 파일의 내용을 뿌려주는 함수 [ 파일 포인터의 끝까지 모든 데이터를 출력해주는 함수]
    // 즉, 파일의 데이터들을 byte단위로 echo해주는 함수
    // byte를 echo시키다가 파일 끝에 도달하면 false가 리턴됨, 즉 false가 오면 파일데이터 출력(download)이 끝났다는것을 의미함.
    if(!fpassthru($fp)) fclose($fp); //fpassthru가 while문. 끝이 false이기에 !false = > true 시켜서 if문 탈출

    


?>