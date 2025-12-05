<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

?>

<?php
$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? '';

if ($country && $lookup !== 'cities') {
    //shows info about country alone
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE ?");
    $stmt->execute(["%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <table>
      <tr>
        <th>Name</th>
        <th>Continent</th>
        <th>Year of Independence</th>
        <th>Head of State</th>
      </tr>
      <?php foreach ($results as $row): ?>
        <tr>
          <td><?=htmlspecialchars($row['name'])?></td>
          <td><?=htmlspecialchars($row['continent'])?></td>
          <td><?=htmlspecialchars($row['independence_year'])?></td>
          <td><?=htmlspecialchars($row['head_of_state'])?></td>
        </tr>
      <?php endforeach; ?>
    </table>
<?php
}

if ($country && $lookup === 'cities') {
    //searching cities via country 
    $stmt2 = $conn->prepare("
        SELECT cities.name, cities.district, cities.population
        FROM cities
        JOIN countries ON countries.code = cities.country_code       
        WHERE countries.name LIKE ?
    ");  //join query sent to the db
    $stmt2->execute(["%$country%"]);
    $results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <table>
      <tr>
        <th>Name</th>
        <th>District</th>
        <th>Population</th>
      </tr>
      <?php foreach ($results2 as $row): ?>
        <tr>
          <td><?=htmlspecialchars($row['name'])?></td>
          <td><?=htmlspecialchars($row['district'])?></td>
          <td><?=htmlspecialchars($row['population'])?></td>
        </tr>
      <?php endforeach; ?>
    </table>
<?php
}
?>


