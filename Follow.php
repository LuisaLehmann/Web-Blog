<?php
include 'classes/DatabaseInteraction.php';

$db_interaction = new DatabaseInteraction();
if (isset($_POST['email']) && isset($_POST['name'])) {
    $db_interaction->createFollower($_POST['email'], $_POST['name']);
}
?>
