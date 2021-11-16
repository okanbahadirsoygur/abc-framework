<?php

/*
 * abc Framework v1 Error Handler
 *
 * Kod yazımı sırasında kritik php hataları burada yakalanır ve yönlendirilir
 *
 *
 * Created by Okan Bahadır Soygür
 *
 */



error_reporting(~0);
ini_set('display_errors', 0);
ini_set('log_errors', 1);


/* Set the error handler. */
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    /* Ignore @-suppressed errors */
    if (!($errno & error_reporting())) return;

    $e = array('type'=>$errno,
        'message'=>$errstr,
        'file'=>$errfile,
        'line'=>$errline);
    redirect($e);

});


/* Set the exception handler. */
set_exception_handler(function ($e) {
    $e = array('type'=>$e->getCode(),
        'message'=>$e->getMessage(),
        'file'=>$e->getFile(),
        'line'=>$e->getLine());
    redirect($e);
});


/* Check if there were any errors on shutdown. */
register_shutdown_function(function () {
    if (!is_null($e = error_get_last())) {
        redirect($e);
    }
});


function format_error_type($type) {


    switch($type) {
        case 0:
            return 'Uncaught exception';
        case E_ERROR: /* 1 */
            return 'E_ERROR';
        case E_WARNING: /* 2 */
            return 'E_WARNING';
        case E_PARSE: /* 4 */
            return 'E_PARSE';
        case E_NOTICE: /* 8 */
            return 'E_NOTICE';
        case E_CORE_ERROR: /* 16 */
            return 'E_CORE_ERROR';
        case E_CORE_WARNING: /* 32 */
            return 'E_CORE_WARNING';
        case E_CORE_ERROR: /* 64 */
            return 'E_COMPILE_ERROR';
        case E_CORE_WARNING: /* 128 */
            return 'E_COMPILE_WARNING';
        case E_USER_ERROR: /* 256 */
            return 'E_USER_ERROR';
        case E_USER_WARNING: /* 512 */
            return 'E_USER_WARNING';
        case E_USER_NOTICE: /* 1024 */
            return 'E_USER_NOTICE';
        case E_STRICT: /* 2048 */
            return 'E_STRICT';
        case E_RECOVERABLE_ERROR: /* 4096 */
            return 'E_RECOVERABLE_ERROR';
        case E_DEPRECATED: /* 8192 */
            return 'E_DEPRECATED';
        case E_USER_DEPRECATED: /* 16384 */
            return 'E_USER_DEPRECATED';
    }
    return $type;
}




//her hata olduğunda bu fonksiyona yönlendirilecektir.
function redirect($e) {
    $now = date('d-M-Y H:i:s');
    $type = format_error_type($e['type']);
    $message = " {$e['message']} in {$e['file']} on line {$e['line']}\n";
    //$error_log_name = ini_get('error_log');
    //error_log($message, 3, $error_log_name);



    //var_export($e);
    switch ($e['type']) {
        /* We'll ignore these errors.  They're only here for reference. */
        case E_WARNING:
        case E_NOTICE:
        case E_CORE_WARNING:
        case E_COMPILE_WARNING:
        case E_USER_WARNING:
        case E_USER_NOTICE:
        case E_STRICT:
        case E_RECOVERABLE_ERROR:
        case E_DEPRECATED:
        case E_USER_DEPRECATED:
        case E_ALL:
            /* Redirect to "oops" page on the following errors. */
        case 0: /* Exceptions return zero for type */
        case E_ERROR:
        case E_PARSE:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:

    }

    //gelen hatalar E_NOTICE değil ise alalım. ve Ekrana basalım
    if($e["type"] != 8   && (ERROR_REPORTING == 1 || ERROR_REPORTING == "1")) {

        echo "<div class=\"\" style=\"border:1px solid gray; max-width: 100%;\">
  <div style='color: red;' class=\"\"><h4><b><center>Kritik PHP Hatası | abc Framework</center></b></h4><hr/></div>
 
  <div style='margin-left: 20px;  margin-bottom: 20px;' class=\"\">
    <h4 style=' '>Hata Tipi: ".$type."</h4>
   <b> <p class=\"\">Hata Mesajı: ".$e["message"]."<br/><br/>Dosya yolu: ".$e["file"]."<br/><br/>Satır: ".$e["line"]."</p></b>
 
   <button style='cursor: pointer;'  onclick='geri()'>Geri</button> 
    <a href='".SITE_URL."'> <button style='cursor:pointer;' >Ana Sayfa</button> </a>
  </div>
  
</div> <script>
    function geri(){

        window.history.back();

    }

</script>";
        //hatayı yakaladıktan sonra bütün kod blogunu kıralım
        exit();

    }


}

?>