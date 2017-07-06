<?php
include 'classes/DatabaseInteraction.php';

$db_interaction = new DatabaseInteraction();
if (isset($_POST['content']) && isset($_POST['beitragsid'])) {
    $db_interaction->createComment($_POST['content'], $_POST['beitragsid']);
}

?>
