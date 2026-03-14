<?php
/**
 * Single Entry Point — Backend Application
 *
 * Alle Requests werden über .htaccess hierher geleitet.
 */

// Bootstrap
require_once __DIR__ . '/../src/bootstrap.php';

// Router initialisieren
$router = new Router();

// ──────────────────────────────────────────
// Admin-Routen (Web-UI, Session-Auth)
// ──────────────────────────────────────────
$router->get('/', 'Admin\DashboardController::index');
$router->get('/login', 'Admin\AuthController::loginForm');
$router->post('/login', 'Admin\AuthController::login');
$router->get('/logout', 'Admin\AuthController::logout');

// TODO: Weitere Admin-Routen ergänzen
// $router->get('/persons', 'Admin\PersonController::index');
// $router->get('/persons/create', 'Admin\PersonController::create');
// $router->post('/persons', 'Admin\PersonController::store');

// ──────────────────────────────────────────
// API-Routen (REST, Bearer-Token-Auth)
// ──────────────────────────────────────────
// $router->get('/api/v1/config', 'Api\ConfigController::index');

// ──────────────────────────────────────────
// Route ausführen
// ──────────────────────────────────────────
$router->dispatch();
