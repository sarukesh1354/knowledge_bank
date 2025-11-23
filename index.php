<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumina Bookstore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="style.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <!--<i class="fas fa-book-open text-2xl text-purple-600 mr-2"></i>-->
                    <span class="font-bold text-xl">Knowledge Bank</span>
                </div>
                
                <!-- Search Form -->
                <form action="index.php" method="GET" class="hidden md:flex flex-1 max-w-lg mx-8">
                    <input type="text" name="search" placeholder="Search titles..." class="w-full border p-2 rounded-l-full px-4 focus:outline-none">
                    <button type="submit" class="bg-purple-600 text-white px-6 rounded-r-full hover:bg-purple-700">Search</Search></button>
                </form>

                <div class="flex items-center space-x-4">
                    <a href="cart.php" class="text-gray-600 hover:text-purple-600 relative">
                        Cart
                        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                            <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                <?php echo count($_SESSION['cart']); ?>
                            </span>
                        <?php endif; ?>
                    </a>
                    
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <span class="text-sm font-semibold text-purple-700">Hi, User</span>
                        <a href="logout.php" class="text-sm text-red-500 hover:underline">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="bg-purple-600 text-white px-4 py-2 rounded-full text-sm hover:bg-purple-700">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-24 pb-12 max-w-7xl mx-auto px-4">
        
        <!-- Hero -->
        <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl p-10 mb-12 text-white text-center shadow-lg">
            <h1 class="text-4xl font-bold mb-4">Your Next Adventure Awaits</h1>
            <p class="mb-6 opacity-90">Browse our collection of bestsellers.</p>
        </div>

        <!-- PHP Book Grid -->
        <h2 class="text-2xl font-bold mb-6">Books Collection</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php
            $sql = "SELECT * FROM books";
            if(isset($_GET['search'])) {
                $search = $conn->real_escape_string($_GET['search']);
                $sql .= " WHERE title LIKE '%$search%' OR author LIKE '%$search%'";
            }
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
            ?>
                <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition overflow-hidden border border-gray-100">
                    <div class="h-64 bg-gray-100 overflow-hidden relative">
                        <img src="<?php echo $row['image_url']; ?>" alt="Book Cover" class="w-full h-full object-cover">
                        <span class="absolute top-2 right-2 bg-white px-2 py-1 text-xs font-bold rounded text-purple-600 shadow">
                            <?php echo $row['category']; ?>
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-lg truncate"><?php echo $row['title']; ?></h3>
                        <p class="text-gray-500 text-sm mb-3"><?php echo $row['author']; ?></p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold">Rs. <?php echo $row['price']; ?></span>
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="book_id" value= '<?php echo $row['book_id']; 
                                ?> '>
                                <button type="submit" class="bg-gray-900 text-white h-10 w-10 rounded-full hover:bg-purple-600 transition flex items-center justify-center">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php 
                }
            } else {
                echo "<p class='text-gray-500'>No books found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>