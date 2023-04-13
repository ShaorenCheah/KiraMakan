<?php
session_start();
include '../connection.inc.php';

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, true);


$type = $data['type'];
if($type=="Operation"){
    $state = $data['state'];
    $restaurantID = $_SESSION['restaurantID'];
    $sql = "UPDATE restaurants SET status = ? WHERE restaurantID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $state, $_SESSION['restaurantID']);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $response = [
        'success' => true,
        'url' => $data['url']
    ];
    echo json_encode($response);
    exit();
}

if($type=="Order"){
    $orderID = $data['orderID'];
    $sql = "UPDATE orders SET status = 'Completed' WHERE orderID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $orderID);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $response = [
        'success' => true,
        'orderID' => $orderID,
        'url' => $data['url']
    ];
    echo json_encode($response);
    exit();
}

if($type=="Update"){
    $status = $data['status'];
    $menuID = $data['menuID'];

    if($status == "Available"){
        $status = "Unavailable";
    }else{
        $status = "Available";
    }

    $sql = "UPDATE menu SET availability = ? WHERE menuID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $status, $menuID);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $response = [
        'success' => true,
        'url' => $data['url']
    ];
    echo json_encode($response);
    exit();
}