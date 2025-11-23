<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto pt-20 px-4">
        <h1 class="text-3xl font-bold mb-8">Shopping Cart</h1>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                // Convert array to comma separated string for SQL (e.g., "1,3,5")
                $ids = implode(',', $_SESSION['cart']);
                $sql = "SELECT * FROM books WHERE id IN ($ids)";
                $result = $conn->query($sql);
                $total = 0;

                while($row = $result->fetch_assoc()) {
                    $total += $row['price'];
            ?>
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <img src="<?php echo $row['image_url']; ?>" class="w-20 h-24 object-cover rounded">
                        <div class="ml-4">
                            <h3 class="text-lg font-bold"><?php echo $row['title']; ?></h3>
                            <p class="text-gray-500"><?php echo $row['author']; ?></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <span class="font-bold text-lg">$<?php echo $row['price']; ?></span>
                        <a href="remove_cart.php?id=<?php echo $row['id']; ?>" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            <?php 
                }
            ?>
                <div class="p-6 bg-gray-50 flex justify-between items-center">
                    <a href="index.php" class="text-purple-600 font-medium hover:underline">&larr; Continue Shopping</a>
                    <div class="text-right">
                        <p class="text-lg text-gray-600">Subtotal</p>
                        <p class="text-2xl font-bold text-gray-900">$<?php echo number_format($total, 2); ?></p>
                        <button class="mt-2 bg-purple-600 text-white px-8 py-3 rounded shadow hover:bg-purple-700 transition">Checkout</button>
                    </div>
                </div>
            <?php
            } else {
                echo "<div class='p-10 text-center text-gray-500'>Your cart is empty. <a href='index.php' class='text-purple-600 underline'>Go shopping</a></div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
