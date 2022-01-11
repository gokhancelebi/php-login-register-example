<?php

session_start();


# pdo database connection
$pdo = new PDO('mysql:host=localhost;dbname=login_register', 'root', '');

# pdo query to count table and get the number of rows
function num_rows($table, $where = [])
{
    #count query
    global $pdo;
    $sql = "SELECT COUNT(*) as sonuc FROM $table";

    #if there is a where clause
    if (count($where) > 0) {
        $sql .= " WHERE ";
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i > 0) {
                $sql .= " AND ";
            }
            $sql .= "$key = :$key";
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute($where);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['sonuc'];

}

# pdo insert to database query function

function db_insert($table, $data)
{
    global $pdo;
    $sql = "INSERT INTO $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i > 0) {
            $sql .= ", ";
        }
        $sql .= "$key = '$value'";
        $i++;
    }
    $query = $pdo->prepare($sql);

    # return inserted id
    if ($query->execute()) {
        return $pdo->lastInsertId();
    } else {
        return false;
    }
}

# pdo update to database query function
function db_update($table, $data, $where)
{
    global $pdo;
    $sql = "UPDATE $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i > 0) {
            $sql .= ", ";
        }
        $sql .= "$key = '$value'";
        $i++;
    }
    $sql .= " WHERE ";
    $i = 0;
    foreach ($where as $key => $value) {
        if ($i > 0) {
            $sql .= " AND ";
        }
        $sql .= "$key = '$value'";
        $i++;
    }
    $query = $pdo->prepare($sql);
    $query->execute();
}

# pdo delete to database query function
function db_delete($table, $where)
{
    global $pdo;
    $sql = "DELETE FROM $table WHERE ";
    $i = 0;
    foreach ($where as $key => $value) {
        if ($i > 0) {
            $sql .= " AND ";
        }
        $sql .= "$key = '$value'";
        $i++;
    }
    $query = $pdo->prepare($sql);
    $query->execute();
}

# pdo select to database query function
function db_select($table,$where = [], $order = [], $limit = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";
    if (count($where) > 0) {
        $sql .= " WHERE ";
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i > 0) {
                $sql .= " AND ";
            }
            $sql .= "$key = '$value'";
            $i++;
        }
    }
    if (count($order) > 0) {
        $sql .= " ORDER BY ";
        $i = 0;
        foreach ($order as $key => $value) {
            if ($i > 0) {
                $sql .= ", ";
            }
            $sql .= "$key $value";
            $i++;
        }
    }
    if (count($limit) > 0) {
        $sql .= " LIMIT ";
        $i = 0;
        foreach ($limit as $key => $value) {
            if ($i > 0) {
                $sql .= ", ";
            }
            $sql .= "$key $value";
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

# pdo select to database query function with left join
function db_select_left_join($table,$table2,$join_on,$where = []){
    # join table
    global $pdo;
    $sql = "SELECT * FROM $table LEFT JOIN $table2 ON $join_on";
    if (count($where) > 0) {
        $sql .= " WHERE ";
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i > 0) {
                $sql .= " AND ";
            }
            $sql .= "$key = '$value'";
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

# pdo select to database query function with right join
function db_select_right_join($table,$table2,$join_on,$where = []){
    # join table
    global $pdo;
    $sql = "SELECT * FROM $table RIGHT JOIN $table2 ON $join_on";
    if (count($where) > 0) {
        $sql .= " WHERE ";
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i > 0) {
                $sql .= " AND ";
            }
            $sql .= "$key = '$value'";
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

# pdo select to database query function with inner join
function db_selec_inner_join($table,$table2,$join_on,$where = []){
    # join table
    global $pdo;
    $sql = "SELECT * FROM $table INNER JOIN $table2 ON $join_on";
    if (count($where) > 0) {
        $sql .= " WHERE ";
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i > 0) {
                $sql .= " AND ";
            }
            $sql .= "$key = '$value'";
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

# pdo select to database query function with full join
function db_select_full_join($table,$table2,$join_on,$where = []){
    # join table
    global $pdo;
    $sql = "SELECT * FROM $table FULL JOIN $table2 ON $join_on";
    if (count($where) > 0) {
        $sql .= " WHERE ";
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i > 0) {
                $sql .= " AND ";
            }
            $sql .= "$key = '$value'";
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

# pdo select with where in
function db_select_where_in($table,$where = [], $order = [], $limit = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";
    if (count($where) > 0) {
        $sql .= " WHERE ";
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i > 0) {
                $sql .= " AND ";
            }
            $sql .= "$key IN ($value)";
            $i++;
        }
    }
    if (count($order) > 0) {
        $sql .= " ORDER BY ";
        $i = 0;
        foreach ($order as $key => $value) {
            if ($i > 0) {
                $sql .= ", ";
            }
            $sql .= "$key $value";
            $i++;
        }
    }
    if (count($limit) > 0) {
        $sql .= " LIMIT ";
        $i = 0;
        foreach ($limit as $key => $value) {
            if ($i > 0) {
                $sql .= ", ";
            }
            $sql .= "$key $value";
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}