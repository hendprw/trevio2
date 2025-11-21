<?php

$routes = [

    // =============================
    // Public Routes
    // =============================
    '/'                     => ['HomeController', 'index'],
    '/hotel'                => ['HomeController', 'detail'],

    // Auth
    '/login'                => ['AuthController', 'login'],
    '/register'             => ['AuthController', 'register'],
    '/logout'               => ['AuthController', 'logout'],

    // Profile
    '/profile'              => ['ProfileController', 'index'],
    '/profile/update'       => ['ProfileController', 'update'],


    // =============================
    // User Routes
    // =============================
    '/my-bookings'          => ['BookingController', 'index'],
    '/booking/store'        => ['BookingController', 'store'],
    '/booking/upload'       => ['BookingController', 'uploadProof'],
    '/booking/checkout'     => ['BookingController', 'checkout'],
    '/booking/payment'      => ['BookingController', 'payment'],
    '/booking/cancel'       => ['BookingController', 'cancel'],


    // =============================
    // Owner Routes
    // =============================
    '/owner/dashboard'      => ['OwnerController', 'dashboard'],
    '/owner/create-hotel'   => ['OwnerController', 'createHotel'],
    '/owner/edit-hotel'     => ['OwnerController', 'editHotel'], // ?id=1
    '/owner/update-hotel'   => ['OwnerController', 'updateHotel'],
    '/owner/delete-hotel'   => ['OwnerController', 'deleteHotel'],

    // Room management
    '/owner/add-room'       => ['OwnerController', 'addRoom'],
    '/owner/delete-room'    => ['OwnerController', 'deleteRoom'],

    // Addon management
    '/owner/add-addon'      => ['OwnerController', 'addAddon'],
    '/owner/delete-addon'   => ['OwnerController', 'deleteAddon'],


    // =============================
    // Admin Routes
    // =============================
    '/admin/dashboard'      => ['AdminController', 'dashboard'],
    '/admin/confirm'        => ['AdminController', 'confirmPayment'], // ?id=
    '/admin/release'        => ['AdminController', 'releaseFund'],    // ?id=
    '/booking/wa-confirm'   => ['AdminController', 'waConfirm'],      // NEW
];

?>
