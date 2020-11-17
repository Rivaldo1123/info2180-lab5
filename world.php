<?php
header('Access-Control-Allow-Origin: *');

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = $_GET['country'];
$country = filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);

$sqlCountry = "SELECT * FROM countries WHERE name LIKE '%$country%'";
$countryQuery = $conn->query($sqlCountry);

$citiesquery= $conn->query("SELECT cities.name, cities.district, cities.population FROM countries join cities on cities.country_code = countries.code WHERE countries.name LIKE '%$country'"); 

$data = $countryQuery->fetchAll(PDO::FETCH_ASSOC);
$cities = $citiesquery->fetchAll(PDO::FETCH_ASSOC);

?>

<?php
if (isset($_GET['context'])) {
  if ($_GET['context'] == 'cities') {

    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th> Name</th>';
    echo '<th> District</th>';
    echo '<th> Population</th>';
    echo '<thead/>';
    echo '</tr>';
    foreach ($cities as $row) {
      echo '<tbody>';
      echo '<tr>';
      echo '<td>';
      echo $row['name'];
      echo '</td>';
      echo '<td>';
      echo $row['district'];
      echo '</td>';
      echo '<td>';
      echo $row['population'];
      echo '</td>';


      echo '</tr>';
      echo '<tbody/>';
    }
  }
} else {
  echo '<table class="table">';
  echo '<thead>';
  echo '<tr>';
  echo '<th> Country Name</th>';
  echo '<th> Continent</th>';
  echo '<th> Independence Year</th>';
  echo '<th> Head of State</th>';
  echo '<th> Population</th>';
  echo '<thead/>';
  echo '</tr>';
  foreach ($data as $row) {
    echo '<tbody>' . '<tr>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['continent'] . '</td>';
    echo '<td>' . $row['independence_year'] . '</td>';
    echo '<td>' . $row['head_of_state'] . '</td>';
    echo '<td>' . $row['population'] . '</td>';

    echo '<tbody/>' . '</tr>';
  }
}

echo '</table>';
?>