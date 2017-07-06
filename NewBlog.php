<?php
include 'classes/DatabaseInteraction.php';

$result_beitrag = null;

$db_interaction = new DatabaseInteraction();
if (isset($_POST['content'])) {
    $result_beitrag = $db_interaction->createBeitrag($_POST['content']);
}
if (isset($_POST['image']) && isset($result_beitrag['beitrag_id'])) {
    $db_interaction->createImage($_POST['image'], $result_beitrag['beitrag_id']);
}
if (isset($_POST['tag']) && isset($result_beitrag['beitrag_id'])) {
    $db_interaction->addIdsToBeitraegeHasTags($_POST['tag'], $result_beitrag['beitrag_id']);
}
?>
