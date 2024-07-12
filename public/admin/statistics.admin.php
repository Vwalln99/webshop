<?php
require 'header.admin.php';
require_once '../../config/database.php';
require_once '../../src/classes/Product.php';
require_once '../../src/classes/Review.php';

$productObj = new Product($pdo);
$reviewObj = new Review($pdo);

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['role'] !== 'admin') {
    header('Location: /webshop/public/index.php');
    exit();
}
$topSellingProducts = $productObj->getTopSellingProducts();
$productsWithRatings = [];

foreach ($topSellingProducts as $product) {
    $averageRating = $reviewObj->getAverageRatingByProductId($product['id']);
    $productsWithRatings[] = [
        'name' => $product['name'],
        'average_rating' => $averageRating
    ];
}
?>

<main>
    <h1>Statistics</h1>
    <div>
        <canvas id="bestRatedProducts"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('bestRatedProducts');
        const productsWithRatings = <?php echo json_encode($productsWithRatings); ?>;

        const names = productsWithRatings.map(product => product.name);
        const ratings = productsWithRatings.map(product => product.average_rating);

        console.log(ratings);
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: names,
                datasets: [{
                    label: 'Best Rated Products',
                    data: ratings,
                    borderWidth: 1,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    hoverBackgroundColor: 'rgba(54, 162, 235, 0.4)',
                    hoverBorderColor: 'rgba(54, 162, 235, 1)',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 5
                    }
                }
            }
        });
    </script>
</main>