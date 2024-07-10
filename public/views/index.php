<?php
require '../../includes/functions.php';
require '../../config/database.php';
require '../../src/vendor/autoload.php';
require '../../src/classes/Database.php';

$db = new Database($config);
$pdo = $db->getConnection();

include '../../includes/header.php';

?>
<main class="main-index">
    <h2>Welcome to our Webshop</h2>
    <p>With us you can shop whatever, wherever and whenever you want.</p>
    <?php
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        echo '<p>Welcome, ' . $_SESSION['username'] . '!</p>';
    }
    ?>
</main>
<?php
include '../../includes/footer.php';
?>