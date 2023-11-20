<?php
include "db.php";

function check_autorize($log, $pass)
{
    $users = get_users();
    return array_key_exists($log, $users) && $pass == $users[$log]['pass'];
}

function check_admin($log, $pass)
{
    $users = get_users();
    return check_autorize($log, $pass) && $users[$log]['role'] == 'admin';
}

function check_role($log, $pass)
{
    $users = get_users();
    return check_autorize($log, $pass) ? $users[$log]['role'] : false;
}

function out_arr()
{
    global $films;
    $arr_out = [];
    foreach ($films as $film) {
        foreach ($film as $key => $value) {
        $str = "<div class='col-lg-12 col-md-6'>
        <div class='item'>
          <div class='row'>
            <div class='col-lg-3'>
              <div class='image'>
                <img src='assets/images/$value.jpg' alt=''>
              </div>
            </div>
            <div class='col-lg-9'>
            <ul>"; 
        }

        foreach ($film as $key => $value) {
            if (!is_array($value)) {
                $str .= "<li>
                <span>$key: </span>
                <h6>$value</h6>
              </li>";
            } else {
                foreach ($value as $k => $v) {
                    $str .= "<li>
                    <span>$k: </span>
                    <h6>$v</h6>
                  </li>";
                }

            }
        }
        $str .= "</ul></div></div></div></div>";
        $arr_out[] = $str;
    }
    return $arr_out;
}

function name($a, $b)
{
    if ($a["name"] < $b["name"]) {
        return -1;
    } elseif ($a["name"] == $b["name"]) {
        return 0;
    } else {
        return 1;
    }
}

function director($a, $b)
{
    if ($a["director"] < $b["director"]) {
        return -1;
    } elseif ($a["director"] == $b["director"]) {
        return 0;
    } else {
        return 1;
    }
}

function genre($a, $b)
{
    if ($a["genre"] < $b["genre"]) {
        return -1;
    } elseif ($a["genre"] == $b["genre"]) {
        return 0;
    } else {
        return 1;
    }
}

function rating($a, $b)
{
    if ($a["rating"] < $b["rating"]) {
        return -1;
    } elseif ($a["rating"] == $b["rating"]) {
        return 0;
    } else {
        return 1;
    }
}

function studio($a, $b)
{
    if ($a["studio"] < $b["studio"]) {
        return -1;
    } elseif ($a["studio"] == $b["studio"]) {
        return 0;
    } else {
        return 1;
    }
}

function year($a, $b)
{
    if ($a["year"] < $b["year"]) {
        return -1;
    } elseif ($a["year"] == $b["year"]) {
        return 0;
    } else {
        return 1;
    }
}

function price($a, $b)
{
    if ($a["price"] < $b["price"]) {
        return -1;
    } elseif ($a["price"] == $b["price"]) {
        return 0;
    } else {
        return 1;
    }
}

function sorting($how_to_sort)
{
    global $films;
    uasort($films, $how_to_sort);
}


function out_arr_search(array $arr_index = null)
{
    global $films;
    $arr_out = [];
    foreach ($films as $index => $film) {
        if ($arr_index != null && in_array($index, $arr_index)) {
                foreach ($film as $key => $value) {
                $str = "<div class='col-lg-12 col-md-6'>
                <div class='item'>
                  <div class='row'>
                    <div class='col-lg-3'>
                      <div class='image'>
                        <img src='assets/images/$value.jpg' alt=''>
                      </div>
                    </div>
                    <div class='col-lg-9'>
                    <ul>"; 
                }
            foreach ($film as $key => $value) {
                if (!is_array($value)) {
                    $str .= "<li>
                                     <span>$key: </span>
                                     <h6>$value</h6>
                                   </li>";
                } else {
                    foreach ($value as $k => $v) {
                        $str .= "<li>
                                            <span>$k: </span>
                                            <h6>$v</h6>
                                          </li>";
                    }
                }
            }
            $str .= "</ul></div></div></div></div>";
            $arr_out[] = $str;
        }
    }
    return $arr_out;
}



function out_search($data)
{
    global $films;
    $arr_index = array();
    foreach ($films as $film_number => $film) {
        foreach ($film as $key => $value) {
            if (!is_array($value)) {
                if (stristr($value, $data)) {
                    $arr_index[] = $film_number;
                }
            } else{
                foreach ($value as $k => $v) {
                    if (stristr($v, $data) || strstr($k, $data)) {
                        $arr_index[] = $film_number;
                    }
                }
            }

        }
    }
    return out_arr_search(array_unique($arr_index));
}

function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

function get_users()
{
    global $users;
    return $users;
}
