<?php
require_once '../config/configuration.php';

// Fonction principale pour executer du sql et catch les erreurs
function run_sql($pdo, $action, $sql) {

    try {
        $result = call_user_func_array(array($pdo, $action), array($sql));
    } catch (PDOException $e) {
        $erreur = 'Error pdo line ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();

        error_log('[ERROR] SQL error : '. $erreur);
        error_log('SQL request : '. $sql);

		die($erreur);
    }

    return $result;
}

// Exécute une requête SQL, retournant un résultat
function sql_query($sql = '') {
    global $database;

    $result = run_sql($database, 'query', $sql);
    return $result;
}

// Exécute une requête SQL et retourne le nombre de lignes affectées
function sql_exec($sql) {
    global $database;

    $result = run_sql($database, 'exec', $sql);
    return $result;
}

// Exécute une requête SQL avec du binding
function sql_binding($sql, $param) {
    global $database;

    $request = run_sql($database, 'prepare', $sql);
    $result  = run_sql($request, 'execute', $param);
    
    return $result;
}