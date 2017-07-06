<?php
include 'classes/DatabaseInteraction.php';

$db_interaction = new DatabaseInteraction();
if (isset($_POST['count_likes']) && isset($_POST['beitragsid'])) {
    $db_interaction->updateBeitraegeLikes($_POST['count_likes'], $_POST['beitragsid']);
}

?>
