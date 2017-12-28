<?php
// foreach ($yourFileName as $key => $v) {
    
//     $savename = date('YmdHis',time()).mt_rand(0,9999).'.jpeg';//localResizeIMG压缩后的图片都是jpeg格式
//     $imgdirs = "Upload/".date('Y-m-d',time()).'/';
//     mkdirs($imgdirs);
//     $savepath = 'Upload/'.date('Y-m-d' ,time()).'/'.$savename; 
//     $image = base64_to_img( $v, $savepath );
//     $imgname[] = $savename;
// }
// $data['image']=implode("||",$imgname).'||';
//return json_encode($myFileName);
// $file = $_FILES['file'];
//     $savename = date('YmdHis',time()).mt_rand(0,9999).'.jpeg';//localResizeIMG压缩后的图片都是jpeg格式
//     $imgdirs = "Upload/".date('Y-m-d',time()).'/';
//     mkdirs($imgdirs);
//     $fileName = $_FILES["file"]["name"];
//     return $fileName;
//     $savepath = 'Upload/'.date('Y-m-d' ,time()).'/'.$savename; 
//     move_uploaded_file($fileName,$savepath);
//     // $image = base64_to_img($fileName , $savepath );
//     // echo $myFileName;
//     if($image){
//         echo '{"status":1,"content":"上传成功","url":"'.$data['image'].'"}';
//     }else{
//         echo '{"status":0,"content":"上传失败"}';
//     } 

//     function base64_to_img( $base64_string, $output_file ) {
//         $ifp = fopen( $output_file, "wb" ); 
//         fwrite( $ifp, base64_decode( $base64_string) ); 
//         fclose( $ifp ); 
//         return( $output_file ); 
//     } 
        function mkdirs($dir, $mode = 0777){
        if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
        if (!mkdirs(dirname($dir), $mode)) return FALSE;
        return @mkdir($dir, $mode);
    } 
    // print_r($_FILES);
    // exit;
// echo $_FILES["file"]["name"];
    $savename = date('YmdHis',time()).mt_rand(0,9999).'.jpeg';//localResizeIMG压缩后的图片都是jpeg格式
    $imgdirs = "Upload/".date('Y-m-d',time()).'/';
    mkdirs($imgdirs);
    $fileName = $_FILES["file"]["name"];
    $savepath = 'Upload/'.date('Y-m-d' ,time()).'/'.$savename; 
    // $data['errno'] = 0;
    $data['data'] = $savepath; 
    move_uploaded_file($_FILES["file"]["tmp_name"],$savepath);
	print_r(json_encode($data));