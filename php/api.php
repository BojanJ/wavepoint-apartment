<?php
include 'db.php';

// Get the page number from the request
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Set the number of items per page
$itemsPerPage = 10;

// Calculate the offset
$offset = ($page - 1) * $itemsPerPage;

// Query the database to get the paginated data
$query = "SELECT * FROM mail_list LIMIT $offset, $itemsPerPage";
$result = mysqli_query($conn, $query);

// Fetch the data and store it in an array
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Get the total number of items
$totalItemsQuery = "SELECT COUNT(*) as total FROM mail_list";
$totalItemsResult = mysqli_query($conn, $totalItemsQuery);
$totalItems = mysqli_fetch_assoc($totalItemsResult)['total'];

// Calculate the total number of pages
$totalPages = ceil($totalItems / $itemsPerPage);

// Create the response array
$response = [
    'page' => $page,
    'total_pages' => $totalPages,
    'total_items' => $totalItems,
    'data' => $data
];

// Convert the response array to JSON
$jsonResponse = json_encode($response);

// Set the response headers
header('Content-Type: application/json');
echo $jsonResponse;

$conn->close();
?>