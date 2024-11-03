<?php

if(!function_exists('db_create')){
    /**
     * @param string $table
     * @param array $data
     * 
     * @return array
     */
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

if (!function_exists('db_update')) {
    /**
     * @param string $table
     * @param array $data
     * @param int $id
     * 
     * @return [type]
     */
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


if (!function_exists('db_delete')) {
    /**
     * @param string $table
     * @param int $id
     * 
     * @return mixed
     */
    function db_delete(string $table, int $id): mixed
    {
        $query = mysqli_query($GLOBALS['connect'], "delete from " . $table . " where id=" . $id);
        $GLOBALS['query'] = $query;
        return $query;
    }
}

if (!function_exists('db_find')) {
    /**
     * @param string $table
     * @param int $id
     * @param string $select='*'
     * 
     * @return mixed
     */
    function db_find(string $table, int $id ,string $select='*'): mixed
    {
        $query = mysqli_query($GLOBALS['connect'], "select * from " . $table . " where id=" . $id);
        $result = mysqli_fetch_assoc($query);
        $GLOBALS['query'] = $query;
        return $result;
    }
}


if (!function_exists('db_frist')) {
    /**
     * @param string $table
     * @param string $query_str
     * @param string $select='*'
     * 
     * @return mixed
     */
    function db_frist(string $table, string $query_str,string $select='*'): mixed
    {
        $sql = "SELECT $select FROM $table $query_str";
        $query = mysqli_query($GLOBALS['connect'], "select ".$select." from " . $table . " " . $query_str);
        $result = mysqli_fetch_assoc($query);
        $GLOBALS['query'] = $query;
        return $result;
    }
}



if (!function_exists('db_get')) {
    /**
     * @param string $table
     * @param string $query_str
     * 
     * @return mixed
     */
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

function render_paginate(int $total_page, ): string
    {
        $request_str = '';
        $current_page = !empty(request('page')) ? (int) request('page') : 1;
        $html = '<ul class="pagination pagination-md justify-content-center" dir="ltr">';

        $previous_disabled = $current_page == 1 ? ' disabled' : '';
        $html .= '<li class="page-item' . $previous_disabled . '">
                    <a class="page-link" href="?page=' . ($current_page - 1) . '&' . $request_str . '" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>';

        for ($i = 1; $i <= $total_page; $i++) {
            $active = $current_page == $i ? ' active' : '';
            $html .= '<li class="page-item' . $active . '"><a href="?page=' . $i . '&' . $request_str . '" class="page-link">' . $i . '</a></li>';
        }

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
    /**
     * @param mixed $connect
     * @param string $table
     * @param string $query_str
     * @param int $limit
     * @param string $orderby
     * @param string $select='*'
     * 
     * @return mixed
     */
    function db_paginate($connect, string $table, string $query_str, int $limit = 15, string $orderby = 'asc', string $select='*'): mixed
    {
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $current_page = $_GET['page'] - 1;
        } else {
            $current_page = 0;
        }

        $query_count = mysqli_query($connect, "SELECT COUNT(" . $table . ".id) FROM " . $table . " " . $query_str);
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



