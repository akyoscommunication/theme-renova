<?php

if(!class_exists("Akyos\\Core\\Wrappers\\Route")) { wp_die("Please install akyos-core via composer. <br> <code>composer require akyos/akyos-x-core</code>"); }

use Akyos\Core\Wrappers\Route;

/**
 * |--------------------------------------------------------------------------
 * | Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here you can register all of the routes for your application.
 * | @see https://akyos.gitbook.io/untitled/php/wordpress-sage/wrappers/router-route-controller
 * |
 */

Route::get('/post', 'PostController@get');


