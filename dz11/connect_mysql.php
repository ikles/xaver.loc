<?php
    require_once $project_root.'/dbsimple/config.php';
    require_once $project_root.'/dbsimple/dbsimple/Generic.php';
    
    $db = DbSimple_Generic::connect('mysqli://form_user:1234@localhost/form'); //здесь нужно прописать параметры доступа к бд

    // Устанавливаем обработчик ошибок.
    $db->setErrorHandler('databaseErrorHandler');
    // Код обработчика ошибок SQL.
    function databaseErrorHandler($message, $info){
        // Если использовалась @, ничего не делать.
        if (!error_reporting()) return;
        // Выводим подробную информацию об ошибке.
        echo "SQL Error: $message<br><pre>"; 
        print_r($info);
        echo "</pre>";
        exit();
    }
    
        
    require_once ($project_root.'/FirePHPCore/FirePHP.class.php');
    // инициализируем класс FirePHP
    $firePHP = FirePHP::getInstance(TRUE);
    // устанавливаем активность
    $firePHP ->setEnabled(true);
    
    $db->setLogger('myLogger');
    
    function myLogger($db, $sql, $caller){
        global $firePHP;
        if (isset($caller['file'])){
            $firePHP->group('at '.@$caller['file'].' line '.@$caller['line']);
        }
        $firePHP->log($sql);
        if (isset($caller['file'])){
        $firePHP->groupEnd();
        }
    }
?>