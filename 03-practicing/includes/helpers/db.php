<?php

/**
 *  insert data in database
 * @param string $table
 * @param array $data
 * @return array as asoc
 */
if(!function_exists('db_create')){
    function db_create(string $table, array $data): array {
        $sql = "INSERT INTO " . $table;
        $columns = "";
        $values = "";
        foreach($data as $key => $value){
            $columns .= $key . ",";
            $values .= "'" . $value . "',";
        }
        
        $columns = rtrim($columns, ",");
        $values = rtrim($values, ",");
        $sql .= " ($columns) VALUES ($values)";
        mysqli_query($GLOBALS['connect'], $sql);
        $id = mysqli_insert_id($GLOBALS['connect']);
        $first = mysqli_query($GLOBALS['connect'], "SELECT * FROM " . $table . " WHERE ID = " . $id);
        $data = mysqli_fetch_assoc($first);
        $GLOBALS['query'] = $first;
        return $data;
    }
}

/**
 * Updating data in database
 * @param string $table
 * @param array $data
 * @param int $id
 * @return array as asoc
 */

if(!function_exists('db_update')){
    function db_update(string $table, array $data, int $id){
        $sql = "UPDATE " . $table . " SET ";
        $columns_value = "";
        foreach($data as $key => $value){
            $columns_value .= $key . " = '" . $value . "',";
        }
        
        $columns_value = rtrim($columns_value, ",");
        $sql .= $columns_value . " WHERE id = ". $id; 
        echo $sql;
        mysqli_query($GLOBALS['connect'], $sql);
        $first = mysqli_query($GLOBALS['connect'], "SELECT * FROM " . $table . " WHERE ID =".$id);
        $data = mysqli_fetch_assoc($first);
        return $data;
    }
}

/**
 * Delete Data from database
 * @param string $table
 * @param int $id
 */
if(!function_exists('db_delete')){
    function db_delete(string $table, int $id):mixed{
        $query = mysqli_query($GLOBALS['connect'], "delete from ".$table." where id=".$id);
        $GLOBALS['query'] = $query;
        return $query;
    }
}


/**
 * Fetch single row Data from database
 * @param string $table
 * @param int $id
 */
if(!function_exists('db_find')){
    function db_find(string $table, int $id):mixed{
        $query = mysqli_query($GLOBALS['connect'], "select * from ".$table." where id=".$id);
        $result =mysqli_fetch_assoc($query);
        $GLOBALS['query'] = $query;
        return $result;
    }
}


/**
 * Search for single row Data from database
 * @param string $table
 * @param int $id
 */
if(!function_exists('db_frist')){
    function db_frist(string $table, string $query_str):mixed{
        $query = mysqli_query($GLOBALS['connect'], "select * from ".$table." ".$query_str);
        $result =mysqli_fetch_assoc($query);
        $GLOBALS['query'] = $query;
        return $result;
    }
}


/**
 * fetch multiple rows Data from database
 * @param string $table
 * @param int $id
 */
if(!function_exists('db_get')){
    function db_get(string $table, string $query_str):mixed{
        $query = mysqli_query($GLOBALS['connect'], "select * from ".$table." ".$query_str);
        $num =mysqli_num_rows($query);
        $GLOBALS['query'] = $query;
        return [
            'query' => $query ,
            'num' => $num,
        ];
    }
}



/**
 * Search multiple and pagination rows Data from database
 * @param string $table
 * @param int $id
 * @param string $query_str
 * @param int $limit
 * @return array
 */
if(!function_exists('render_pagenation')){
    function render_paginate( int $total_page):string{
        
        $html= '<ul>';
        for($i= 0; $i<$total_page;$i++){
            $html.= '<li><a href="?page= {$i}">'.$i.'</a></li>';
        }
        $html.='</ul>';
        return $html;
    }
}
if (!function_exists('db_paginate')) {
    function db_paginate($connect, string $table, string $query_str, int $limit = 15, string $orderby = 'asc'): mixed {
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $current_page = $_GET['page'] - 1;
        } else {
            $current_page = 0;
        }

        $query_count = mysqli_query($connect, "SELECT COUNT(id) FROM " . $table . " " . $query_str);
        if (!$query_count) {
            die("Query failed: " . mysqli_error($connect));
        }
        
        $count = mysqli_fetch_row($query_count);
        $total_records = $count[0];

        $start = $current_page * $limit;
        $total_page = ceil($total_records / $limit);

        if ($current_page >= $total_page) {
            $current_page = $total_page - 1;
        }
        
        $query = mysqli_query($connect, "SELECT * FROM " . $table . " " . $query_str . " ORDER BY id " . $orderby . " LIMIT {$start},{$limit}");
        if (!$query) {
            die("Query failed: " . mysqli_error($connect));
        }

        $num = mysqli_num_rows($query);

        return [
            'query' => $query,
            'num' => $num,
            'render' => render_paginate($total_page),
            'current_page' => $current_page,
            'limit' => $limit,
        ];
    }
}

//$user = db_paginate("user","",2);
// while($row = mysqli_fetch_assoc($user['query'])){
//     echo $row['email']."<br>";
// }
// echo $user['render'];

