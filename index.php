<?php
include "db.php";
include "header.php";
include "action.php";
?>
<!-- ***** Main Banner Area Start ***** -->
<div class="main-banner" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="owl-carousel owl-banner">
            <div class="item item-1">
              <div class="header-text">
                <span class="category">Our Courses</span>
                <h2>With Scholar Teachers, Everything Is Easier</h2>
                <p>Scholar is free CSS template designed by TemplateMo for online educational related websites. This layout is based on the famous Bootstrap v5.3.0 framework.</p>
                <div class="buttons">
                  <div class="main-button">
                    <a href="#">Request Demo</a>
                  </div>
                  <div class="icon-button">
                    <a href="#"><i class="fa fa-play"></i> What's Scholar?</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item item-2">
              <div class="header-text">
                <span class="category">Best Result</span>
                <h2>Get the best result out of your effort</h2>
                <p>You are allowed to use this template for any educational or commercial purpose. You are not allowed to re-distribute the template ZIP file on any other website.</p>
                <div class="buttons">
                  <div class="main-button">
                    <a href="#">Request Demo</a>
                  </div>
                  <div class="icon-button">
                    <a href="#"><i class="fa fa-play"></i> What's the best result?</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item item-3">
              <div class="header-text">
                <span class="category">Online Learning</span>
                <h2>Online Learning helps you save the time</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temporious incididunt ut labore et dolore magna aliqua suspendisse.</p>
                <div class="buttons">
                  <div class="main-button">
                    <a href="#">Request Demo</a>
                  </div>
                  <div class="icon-button">
                    <a href="#"><i class="fa fa-play"></i> What's Online Course?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- ***** Main Banner Area End ***** -->
<?php
$autorized = false;
if (isset($_POST["go"])) {
    $login = $_POST["login"];
    $password = $_POST["pass"];
    check_role($login, $password) . "<br>";
    if (check_autorize($login, $password)) {
        $autorized = true;
        echo "Hello, $login";
        if (check_admin($login, $password)) {
            echo "<a href='hello.php?login=$login'>Просмотр отчета</a>";
        }

    } else {
        echo "You are not registered";
    }
}
$user_form = '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="autoForm" onsubmit="return verify(this)">
<input type="text" name="login" placeholder="Input login">
<input type="password" name="pass" placeholder="Input password">
<input type="submit" value="Go" name="go">
</form>';

if (!$autorized) {
    echo $user_form;
}



echo "<h1>Найкращі фільми всіх часів знову у кіно!</h1>"; ?>

<h3>Сортувати фільми за</h3>
<form action="index.php" method="post" name="sort_form">
    <select name="sort" id="sort" size="1">
        <option value="name" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "name") echo "selected"; ?> >назвою</option>
        <option value="director" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "director") echo "selected"; ?>>іменем режисера</option>
        <option value="genre" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "genre") echo "selected"; ?>>жанру</option>
        <option value="rating" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "rating") echo "selected"; ?>>рейтингу</option>
        <option value="studio" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "studio") echo "selected"; ?>>киностудии</option>
        <option value="year" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "year") echo "selected"; ?>>году выпуска</option>
        <option value="sessions" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "sessions") echo "selected"; ?>>началу сеанса</option>
        <option value="price" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "price") echo "selected"; ?>>стоимости билета</option>
    </select>
    <input type="submit" name="submit" value="OK">
</form>

<?php
if (isset($_POST['sort'])) {
    $how_to_sort = $_POST['sort'];
    sorting($how_to_sort);
}

$out = out_arr();

if (count($out) > 0) {
    foreach ($out as $row) {
        echo "<div>$row</div>";
    }
} else {
    echo "No data...";
}

$str_form_search = "
<div class=\"container\">
    <h3>Search:</h3>
    <form name='searchForm' action='index.php' method='post' onSubmit='return overify_login(this);'>
        <input type='text' name='search' class='form-control'>
        <input type='submit' name='gosearch' value='Confirm' class='btn btn-secondary my-2'>
    </form>
</div>";

echo $str_form_search;

if (isset($_POST['gosearch'])) {
    $data = test_input($_POST['search']);
    $out = out_search($data);

// вызов функции out_arr() из action.php для получения массива
    if (count($out) > 0) {
        foreach ($out as $row) { //вывод массива построчно
            echo "<div>$row</div>";
        }
    } else // если нет данных
    {
        echo "Nothing found...";
    }
}

include "footer.php";