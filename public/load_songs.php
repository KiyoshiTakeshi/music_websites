<?php
include "../app/core/functions.php";
if(isset($_SESSION['uid']) && isset($_GET['option']) && isset($_GET['id'])) {
    $option = $_GET['option'];
    $id = $_GET['id'];
    $uid = $_SESSION['uid']; 
// if(isset($_GET['option']) && isset($_GET['id'])) {
//     $option = $_GET['option'];
//     $id = $_GET['id'];

    if($option === 'playlist') {
        $songs = get_songs_by_playlist($id);
    } elseif($option === 'album') {
        $songs = get_songs_by_album($id);
    } elseif($option === 'artist') {
        $songs = get_songs_by_artist($id);
    } elseif( $option === 'all'){
        $songs = get_all_songs();
    } elseif( $option === 'top'){
        $songs = get_top_songs(10);
    }
    // } elseif( $option === 'like'){
    //     $songs = get_favorite_songs($uid)
    // }
    displaySongs($songs);
}
?>