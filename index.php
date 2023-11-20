<?php
include "db.php";
include "header.php";
include "action.php";
?>

<div class="main-banner" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="owl-carousel owl-banner">
            <div class="item item-1">  
 <div class="header-text" ;>
              <span class="category">Cinema+</span>
                <h2>Наш кінотеатр</h2>
                <p>
Ласкаво просимо в наш сучасний кінотеатр, де кожен візит – це неповторна кінематографічна пригода!</p>
                <div class="buttons">
                  <div class="icon-button">
                    <a href="#start"><i class="fa fa-play"></i>Почати!</a>
                  </div>
                </div>
              </div>
            </div> 
            <div class="item item-2">
              <div class="header-text">
                <span class="category">Cinema+</span>
                <h2>Комфорт відвідувачів для нас у пріорітеті</h2>
                <p>Наш кінотеатр створений для комфортного та захоплюючого перегляду фільмів у високій якості. Ми прагнемо забезпечити найкращі умови для наших глядачів, починаючи від сучасного обладнання та закінчуючи затишною атмосферою наших залів.</p>
                <div class="buttons">
                  <div class="icon-button">
                    <a href="#start"><i class="fa fa-play"></i> Почати!</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item item-3">
              <div class="header-text">
                <span class="category">Cinema+</span>
                <h2>Враження</h2>
                <p>Приходьте до нас і дайте нам можливість зробити ваш вечір незабутнім!</p>
                <div class="buttons">
                  <div class="icon-button">
                    <a href="#start"><i class="fa fa-play"></i>Почати!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



<div id="start">
</div>
<div class="section events" id="films">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading">
            <h6>Вже з наступного понеділка</h6>
            <h2>Найкращі фільми всіх часів знову у кіно!</h2>

<h4>Для зручності оберіть сортування</h4>
<form action="index.php" method="post" name="sort_form">
    <select name="sort" id="sort" size="1"  class="form-select-sm">
        <option value="name" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "name") echo "selected"; ?> >за назвою</option>
        <option value="director" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "director") echo "selected"; ?>>за іменем режисера</option>
        <option value="genre" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "genre") echo "selected"; ?>>за жанром</option>
        <option value="rating" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "rating") echo "selected"; ?>>за рейтингом</option>
        <option value="studio" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "studio") echo "selected"; ?>>за кіностудією</option>
        <option value="year" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "year") echo "selected"; ?>>за роком випуску</option>
        <option value="price" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "price") echo "selected"; ?>>за вартістю квитка</option>
    </select>
    <input type="submit" name="submit" value="OK" class="btn btn-primary my-2">
</form>
</div>
</div>
<?php
if (isset($_POST['sort'])) {
  $how_to_sort = $_POST['sort'];
  sorting($how_to_sort);
}

$out = out_arr();

if (count($out) > 0) {
  foreach ($out as $row) {
    echo $row;
               }
} else {
  echo "No data...";
}

$str_form_search = "
    <div class='container'>
      <div class='row'>
        <div class='col-lg-12'>
          <div class='section-heading'>
    <form name='searchForm' action='index.php' method='post' onSubmit='return overify_login(this);' >
        <input type='text' name='search' class='form-control' placeholder='Пошук фільмів'>
        <input type='submit' name='gosearch' value='Confirm' class='btn btn-primary my-2'>
        <input type='reset' name='clear' value='Reset'  class='btn btn-primary my-2'>
    </form>
</div>
</div>
</div>
</div>
";

echo $str_form_search;

if (isset($_POST['gosearch'])) {
    $data = test_input($_POST['search']);
    $out = out_search($data);

    if (count($out) > 0) {
        foreach ($out as $row) { 
            echo "<div>$row</div>";
        }
    } else
    {
        echo "<h4>На жаль, на ваш запит інформація відсутня...</h4>";
    }
}
?>

<div class="contact-us section" id="login">
    <div class="container">
      <div class="row">
        <div class="col-lg-6  align-self-center">
          <div class="section-heading">
            <h2>Форма авторизації</h2>
            <p>Для того, щоб стати повноцінним учасником нашого ком'юніті кіноманов, увійдіть у свій аккаунт</p>
            <div class="special-offer">
              <span class="offer"></span>
              <h4>Ви можете переглядати сайт, не входячи в аккаунт</h4>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="contact-us-content">
<?php
  $autorized = false;
if (isset($_POST["go"])) {
    $login = $_POST["login"];
    $password = $_POST["pass"];
    check_role($login, $password) . "<br>";
    if (check_autorize($login, $password)) {
        $autorized = true;
        echo "<h3>Вітаємо, $login!</h3>";
        if (check_admin($login, $password)) {
            echo "Ви зайшли під правами адміністратора";
        }

    } else {
        echo "Ви не зареєстровані на нашому сайті";
    }
}

$user_form = '
<form id="contact-form" action="' . $_SERVER['PHP_SELF'] . '" method="post" name="autoForm" onsubmit="return verify(this)">
          <div class="row">
            <div class="col-lg-12">
              <fieldset>
                <input type="text" name="login" placeholder="Логін">
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <input type="password" name="pass" placeholder="Пароль">
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <button type="submit" id="form-submit" class="orange-button" value="Go" name="go">Підтвердити</button>
              </fieldset>
            </div>
          </div>
        </form>';

if (!$autorized) {
    echo $user_form;
}?>

      </div>
    </div>
  </div>
</div>
</div>
<?php
include "footer.php";
?>