<?php

/**
 *  insert data in database
 * @param string $table
 * @param array $data
 * @return array as asoc
 */
if (!function_exists('db_create')) {
    function db_create(string $table, array $data): array
    {
        $sql = "INSERT INTO " . $table;
        $columns = "";
        $values = "";
        foreach ($data as $key => $value) {
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

if (!function_exists('db_update')) {
    function db_update(string $table, array $data, int $id)
    {
        $sql = "UPDATE " . $table . " SET ";
        $columns_value = "";
        foreach ($data as $key => $value) {
            $columns_value .= $key . " = '" . $value . "',";
        }

        $columns_value = rtrim($columns_value, ",");
        $sql .= $columns_value . " WHERE id = " . $id;
        echo $sql;
        mysqli_query($GLOBALS['connect'], $sql);
        $first = mysqli_query($GLOBALS['connect'], "SELECT * FROM " . $table . " WHERE ID =" . $id);
        $data = mysqli_fetch_assoc($first);
        return $data;
    }
}

/**
 * Delete Data from database
 * @param string $table
 * @param int $id
 */
if (!function_exists('db_delete')) {
    function db_delete(string $table, int $id): mixed
    {
        $query = mysqli_query($GLOBALS['connect'], "delete from " . $table . " where id=" . $id);
        $GLOBALS['query'] = $query;
        return $query;
    }
}


/**
 * Fetch single row Data from database
 * @param string $table
 * @param int $id
 */
if (!function_exists('db_find')) {
    function db_find(string $table, int $id ,string $select='*'): mixed
    {
        $query = mysqli_query($GLOBALS['connect'], "select * from " . $table . " where id=" . $id);
        $result = mysqli_fetch_assoc($query);
        $GLOBALS['query'] = $query;
        return $result;
    }
}


/**
 * Search for single row Data from database
 * @param string $table
 * @param int $id
 */
if (!function_exists('db_frist')) {
    function db_frist(string $table, string $query_str,string $select='*'): mixed
    {
        $sql = "SELECT $select FROM $table $query_str";
        $query = mysqli_query($GLOBALS['connect'], "select ".$select." from " . $table . " " . $query_str);
        $result = mysqli_fetch_assoc($query);
        $GLOBALS['query'] = $query;
        return $result;
    }
}


/**
 * fetch multiple rows Data from database
 * @param string $table
 * @param int $id
 */
if (!function_exists('db_get')) {
    function db_get(string $table, string $query_str): mixed
    {
        $query = mysqli_query($GLOBALS['connect'], "select * from " . $table . " " . $query_str);
        $num = mysqli_num_rows($query);
        $GLOBALS['query'] = $query;
        return [
            'query' => $query,
            'num' => $num,
        ];
    }
}



if (!function_exists('render_paginate')) {
    /**
     * Render a pagination control.
     *
     * @param int   $total_page The total number of pages.
     * @param array $appends    An array of query string parameters to append to the pagination links.
     *
     * @return string The rendered pagination control HTML.
     */
    function render_paginate(int $total_page, array $appends = []): string
    {
        $request_str = '';
        
        // Handle additional query string parameters if provided
        if (!empty($appends)) {
            foreach ($appends as $key => $val) {
                $request_str .= $key . '=' . urlencode($val) . '&'; // Encoding values for safety
            }
        }

        // Remove the trailing '&' from the query string, if present
        $request_str = rtrim($request_str, '&');

        $current_page = !empty(request('page')) ? (int) request('page') : 1;
        $html = '<ul class="pagination pagination-md justify-content-center" dir="ltr">';

        // Previous button logic
        $previous_disabled = $current_page == 1 ? ' disabled' : '';
        $html .= '<li class="page-item' . $previous_disabled . '">
                    <a class="page-link" href="?page=' . ($current_page - 1) . '&' . $request_str . '" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>';

        // Loop through pages
        for ($i = 1; $i <= $total_page; $i++) {
            $active = $current_page == $i ? ' active' : '';
            $html .= '<li class="page-item' . $active . '">
                        <a href="?page=' . $i . '&' . $request_str . '" class="page-link">' . $i . '</a>
                      </li>';
        }

        // Next button logic
        $next_disabled = $current_page == $total_page ? ' disabled' : '';
        $html .= '<li class="page-item' . $next_disabled . '">
                    <a class="page-link" href="?page=' . ($current_page + 1) . '&' . $request_str . '" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>';

        $html .= '</ul>';
        return $total_page > 0 ? $html : "";
    }
}




if (!function_exists('db_paginate')) {
    function db_paginate($connect, string $table, string $query_str, int $limit = 15, string $orderby = 'asc', string $select='*'): mixed
    {
        // Determine the current page
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $current_page = $_GET['page'] - 1;
        } else {
            $current_page = 0;
        }

        // Query to count the total number of records in the table
        $query_count = mysqli_query($connect, "SELECT COUNT(" . $table . ".id) FROM " . $table . " " . $query_str);
        if (!$query_count) {
            die("Query failed: " . mysqli_error($connect));
        }

        $count = mysqli_fetch_row($query_count);
        $total_records = $count[0];

        // Calculate the starting record for the current page and the total number of pages
        $start = $current_page * $limit;
        $total_page = ceil($total_records / $limit);

        // Ensure the current page does not exceed the total number of pages
        if ($current_page >= $total_page) {
            $current_page = $total_page - 1;
        }

        // Perform the actual query with pagination
        $query = mysqli_query($connect, "SELECT " . $select . " FROM " . $table . " " . $query_str . " ORDER BY " . $table . ".id " . $orderby . " LIMIT {$start}, {$limit}");
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
// $user = db_paginate("user", "", 10); // Here "user" is the correct table name.
// while ($row = mysqli_fetch_assoc($user['query'])) {
//     echo $row['email'] . "<br>";
// }
// echo $user['render'];

//$user = db_paginate("user","",2);
// while($row = mysqli_fetch_assoc($user['query'])){
//     echo $row['email']."<br>";
// }
// echo $user['render'];

if (!function_exists('db_setting_strict')) {
    function db_setting_strict() {
        global $connect; // Use the `global` keyword to access the $connect variable
        $currentSqlMode = mysqli_query($connect, "SELECT @@sql_mode");
        $currentSqlMode = mysqli_fetch_assoc($currentSqlMode)['@@sql_mode'];
        $newSqlMode = str_replace('ONLY_FULL_GROUP_BY', '', $currentSqlMode);
        mysqli_query($connect, "SET GLOBAL sql_mode='$newSqlMode'");
    }
}