<?php

require '../../config/database.php';
require '../../src/classes/Product.php';
require 'header.admin.php';

$productObj = new Product($pdo);
$categories = $productObj->getAllCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'] ?? null;
        $description = $_POST['description'] ?? null;
        $price = $_POST['price'] ?? null;
        $category_id = $_POST['category_id'] ?? null;

        if ($name && $description && $price) {
            $productObj->addProduct($name, $description, $price, $category_id);
        } else {
            echo "Bitte füllen Sie alle Felder aus.";
        }
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? null;
        $description = $_POST['description'] ?? null;
        $price = $_POST['price'] ?? null;
        $category_id = $_POST['category_id'] ?? null;

        if ($id && $name && $description && $price && $category_id) {
            $productObj->updateProduct($id, $name, $description, $price, $category_id);
        } else {
            echo "Bitte füllen Sie alle Felder aus.";
        }
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'] ?? null;

        if ($id) {
            $productObj->deleteProduct($id);
        } else {
            echo "Produkt-ID nicht angegeben.";
        }
    } elseif (isset($_POST['upload_image'])) {
        $id = $_POST['id'] ?? null;
        if ($id && isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $upload_dir = __DIR__ . '/uploads/';
            $image_name = basename($_FILES['image']['name']);
            $image_url = "/webshop/public/admin/uploads/" . $image_name;

            $target_file = $upload_dir . $image_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $productObj->uploadProductImage($id, $image_url);
            } else {
                echo "Bild konnte nicht hochgeladen werden.";
            }
        } else {
            echo "Produkt-ID oder Bild nicht angegeben.";
        }
    }
}

$products = $productObj->getAllProducts();
?>

<main>

    <h2>Produkte verwalten</h2>

    <h3>Produkt hinzufügen</h3>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Beschreibung:</label>
        <input type="text" id="description" name="description" required><br><br>

        <label for="price">Preis:</label>
        <input type="number" id="price" name="price" step="0.01" required><br><br>

        <label for="category_id">Kategorie:</label>
        <select name="category_id" id="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" name="add" value="Hinzufügen">
    </form>

    <h3>Vorhandene Produkte</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Beschreibung</th>
            <th>Preis</th>
            <th>Kategorie</th>
            <th>Bilder</th>
            <th>Aktionen</th>
        </tr>
        <?php foreach ($products as $product) : ?>
            <tr>
                <form method="post" action="" enctype="multipart/form-data">
                    <td><?php echo $product['id']; ?></td>
                    <td><input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>"></td>
                    <td><input type="text" name="description" value="<?php echo htmlspecialchars($product['description']); ?>"></td>
                    <td><input type="number" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>"></td>
                    <td>
                        <select name="category_id">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $product['category_id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <?php
                        $images = $productObj->getProductImages($product['id']);
                        if ($images) {
                            foreach ($images as $image) {
                                echo '<img src="' . htmlspecialchars($image['image_url']) . '" alt="' . htmlspecialchars($product['name']) . '>';
                            }
                        }
                        ?>
                        <input type="file" name="image">
                        <input type="submit" name="upload_image" value="Bild hochladen">
                    </td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <input type="submit" name="update" value="Aktualisieren">
                        <input type="submit" name="delete" value="Löschen">
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
</main>