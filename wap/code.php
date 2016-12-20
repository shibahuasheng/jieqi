<?php
        session_start ();
        header ( 'Content-type: image/png' );
        $im = imagecreate($x=80,$y=25 );
        $bg = imagecolorallocate($im,rand(10,20),rand(130,170),rand(200,255));
        $fontColor = imageColorAllocate ( $im, 255, 255, 255 );
        $fontstyle = 'style/font/ARIAL.TTF';
        for($i = 0; $i < 4; $i ++) {
                $randAsciiNumArray         = array (rand(48,57),rand(65,90));
                $randAsciiNum                 = $randAsciiNumArray [rand ( 0, 1 )];
                $randStr                         = chr ( $randAsciiNum );
                imagettftext($im,14,rand(0,20)-rand(0,25),5+$i*18,rand(18,22),$fontColor,$fontstyle,$randStr);
                $authcode                        .= $randStr; 
        }
        $_SESSION['_17mb_code'] = $authcode;
        for ($i=0;$i<5;$i++){
                $lineColor        = imagecolorallocate($im,rand(50,100),rand(120,150),rand(100,200));
                imageline ($im,rand(0,$x),0,rand(0,$x),$y,$lineColor);
        }
        for ($i=0;$i<250;$i++){
                //imagesetpixel($im,rand(0,$x),rand(0,$y),$fontColor);
        }
        imagepng($im);
        imagedestroy($im);                
?>