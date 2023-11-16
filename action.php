<?php
include "db.php";
// function check_autorize($log, $pass)
// {
//     global $users;
//     $users = get_users();
//     return array_key_exists($log, $users) && $pass == $users[$log]['pass'];
// }

// function check_admin($log, $pass)
// {
//     global $users;
//     $users = get_users();
//     return check_autorize($log, $pass) && $users[$log]['role'] == 'admin';
// }

// function check_role($log, $pass)
// {
//     global $users;
//     $users = get_users();
//     return check_autorize($log, $pass) ? $users[$log]['role'] : false;
// }

function check_autorize($log, $pass)
{
    //global $users;
    $users = get_users();
    return array_key_exists($log, $users) && $pass == $users[$log]['pass'];
}

function check_admin($log, $pass)
{
    //global $users;
    $users = get_users();
    return check_autorize($log, $pass) && $users[$log]['role'] == 'admin';
}

function check_role($log, $pass)
{
    //global $users;
    $users = get_users();
    return check_autorize($log, $pass) ? $users[$log]['role'] : false;
}

// function film_list()
// {
//     global $films;
//     // делаем переменную $films глобальной
//     $arr_out = [];
//     $arr_out[] = "<ol>";
//     //$arr_out[] = "<li>name</li><li>genre</li><li>director</li><li>year</li><li>studio</li><li colspan=2>sessions</li>";
//     //$films = $films[0];
//     foreach ($films as $film) {
//         $str = "<li>";
//         foreach ($film as $key => $value) {
//             if (!is_array($value)) {
//                 $str .= "<li>$key: $value</li>";
//             } else {
//                 foreach ($value as $k => $v) {
//                     $str .= "<ol><li>$k: $v</li></ol>";
//                 }

//             }

//         }
//         $str .= "</li>";
//         $arr_out[] = $str;
//     }
//     $arr_out[] = "</ol>";
//     return $arr_out;
// }
function film_list()
{
    global $films;
    // делаем переменную $films глобальной
    $arr_out = [];
    $arr_out[] = "<ul>";
    //$arr_out[] = "<ul><li>№</li><li>name</li><li>genre</li><li>director</li><li>year</li><li>studio</li><li colspan=2>sessions</li><li>price</li></ul>";
    foreach ($films as $film) {
        static $i = 1;
        //статическая глобальная переменная-счетчик
        $str = "<ul>";
        $str .= "<li>" . $i . "</li>";
        foreach ($film as $key => $value) {
            if (!is_array($value)) {
                $str .= "<li>$key: $value</li>";
            } else {
                foreach ($value as $k => $v) {
                    $str .= "<li>$k: $v</li>";
                }

            }
        }
        $str .= "</ul>";
        $arr_out[] = $str;
        $i++;
    }
    $arr_out[] = "</ul>";
    return $arr_out;
}


function out_arr()
{
    global $films;
    // делаем переменную $films глобальной
    $arr_out = [];
    $arr_out[] = "<ul>";
    //$arr_out[] = "<li><li>№</li><li>name</li><li>genre</li><li>director</li><li>year</li><li>rating</li><li>studio</li><li>sessions</li><li>price</;></д>";
    foreach ($films as $film) {
        static $i = 1;
        //статическая глобальная переменная-счетчик
        $str = "<ul>";
        //$str .= "<li>" . $i . "</li>";
        foreach ($film as $key => $value) {
            if (!is_array($value)) {
                $str .= "<li>$key: $value</li>";
            } else {
                foreach ($value as $k => $v) {
                    $str .= "<li>$k: $v</li>";
                }

            }
        }
        $str .= "</ul>";
        $arr_out[] = $str;
        $i++;
    }
    $arr_out[] = "</ul>";
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

// function sessions($a, $b)
// {
//     if ($a["population"]["2000"] + $a["population"]["2010"] < $b["population"]["2000"] + $b["population"]["2010"]) {
//         return -1;
//     } elseif ($a["population"]["2000"] + $a["population"]["2010"] == $b["population"]["2000"] + $b["population"]["2010"]) {
//         return 0;
//     } else {
//         return 1;
//     }
// }

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

// function out_arr_search(array $arr_index = null)
// {
//     global $films;
//     global $films;
//     // делаем переменную $films глобальной
//     $arr_out = [];
//     $arr_out[] = "<table class='out' border='1'>";
//     $arr_out[] = "<tr><td>№</td><td>name</td><td>genre</td><td>director</td><td>year</td><td>rating</td><td>studio</td><td colspan=2>sessions</td><td>price</td></tr>";
//     foreach ($films as $index => $film) {
//         if ($arr_index != null && in_array($index, $arr_index)) {
//             static $i = 1;
//             $str = "<tr>" . "<td>" . $i . "</td>";
//             foreach ($film as $key => $value) {
//                 if (!is_array($value)) {
//                     $str .= "<td>$value</td>";
//                 } else {
//                     foreach ($value as $k => $v) {
//                         $str .= "<td>$v</td>";
//                     }
//                 }
//             }
//             $str .= "<td>" . "</td></tr>";
//             $arr_out[] = $str;
//             $i++;
//         }
//     }
//     $arr_out[] = "</table>";
//     return $arr_out;
// }

// function out_search($data)
// {
//     global $films;
//     $arr_index = array();
//     foreach ($films as $film_number => $film) {
//         foreach ($film as $key => $value) {
//             if (!is_array($value)) {
//                 if (stristr($value, $data)) {
//                     $arr_index[] = $film_number;
//                 }
//             } else {
//                 foreach ($value as $k => $v) {
//                     if (stristr($v, $data) || strstr($k, $data)) {
//                         $arr_index[] = $film_number;
//                     }
//                 }
//             }
//         }
//     }
//     return out_arr_search(array_unique($arr_index));
// }

// function get_users()
// {
//     global $users;
//     return $users;
// }

// function test_input($data)
// {
//     return htmlspecialchars(stripslashes(trim($data)));
// }


// function out_arr()
// {
//     global $films;
//     // делаем переменную $films глобальной
//     $arr_out = [];
//     $arr_out[] = "<ul>";
//     //$arr_out[] = "<tr><td>№</td><td>name</td><td>genre</td><td>director</td><td>year</td><td>rating</td><td>studio</td><td colspan=2>sessions</td><td>price</td></tr>";
//     foreach ($films as $film) {
//         static $i = 1;
//         //статическая глобальная переменная-счетчик
//         $str = "<ul>";
//         //$str .= "<li>" . $i . "</li>";
//         foreach ($film as $key => $value) {
//             if (!is_array($value)) {
//                 $str .= "<li>$key: $value</li>";
//             } else {
//                 foreach ($value as $k => $v) {
//                     $str .= "<li>$k: $v</li>";
//                 }

//             }
//         }
//         $str .= "</ul>";
//         $arr_out[] = $str;
//         $i++;
//     }
//     $arr_out[] = "</ul>";
//     return $arr_out;
// }


function out_arr_search(array $arr_index = null)
{
    global $films; // делаем переменную $films глобальной
    $arr_out = [];
    $arr_out[] = "<ul>";
    foreach ($films as $index => $film) {
        if ($arr_index != null && in_array($index, $arr_index)) {
            $str = "<ul>";
            foreach ($film as $key => $value) {
                if (!is_array($value)) {
                    $str .= "<li>$key: $value</li>";
                } else {
                    foreach ($value as $k => $v) {
                        $str .= "<li>$k: $v</li>";
                    }
                }
            }
            $str .= "</ul>";
            $arr_out[] = $str;
        }
    }
    $arr_out[] = "</ul>";
    return $arr_out;
}



function out_search($data)
{
    global $films; // делаем переменную $films глобальной
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