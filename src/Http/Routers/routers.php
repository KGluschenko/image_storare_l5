<?php

Route::group (['middleware' => ['web']], function () {

    Route::group (
        ['prefix' => 'admin/image_storage', 'middleware' => 'auth.admin'], function () {

        include("routers_images.php");

        include("routers_galleries.php");

        include("routers_tags.php");

        include("routers_videos.php");

        include("routers_video_galleries.php");

    });
});


