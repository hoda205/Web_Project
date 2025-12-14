<?php
session_start();

if (isset($_POST['pageId'])&& isset($_POST['sidebar'])) {
    $_SESSION['pageId'] = $_POST['pageId'] ;
    $_SESSION['sidebar'] = $_POST['sidebar'] ;
}