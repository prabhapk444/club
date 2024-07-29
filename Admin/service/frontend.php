<?php

function getLeaders($conn) {
    $sql = "SELECT * FROM leaders";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $leaders = [];
        while($row = $result->fetch_assoc()) {
            $leaders[] = $row;
        }
        return $leaders;
    } else {
        return [];
    }
}

function  getWeImages($conn){
    $sql = "SELECT * FROM weimages";
    $result = $conn->query($sql);
    if ($result->num_rows >0) {
        $weimage =[];
        while($row = $result->fetch_assoc()){
            $weimage[] = $row;
        }
        return $weimage;
    }else {
        return [];
    }
}

function getGalleryImages($conn){
    $sql="SELECT * FROM gallery";
    $result = $conn->query($sql);
    if ($result->num_rows >0) {
        $gallery=[];
        while ($row=$result->fetch_assoc()) {
            $gallery[]=$row;
        }
        return $gallery;
    }else{
        return [];
    }
}
function getSponsers($conn){
    $sql ="SELECT * FROM sponsers";
    $result =$conn->query($sql);
    if ($result->num_rows > 0) {
        $sponsers=[];
        while ($row =$result->fetch_assoc()) {
            $sponsers[]=$row;
        }
        return $sponsers;
    }else return [];
}


?>
