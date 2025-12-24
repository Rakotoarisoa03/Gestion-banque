<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Account::index');

$routes->get('accounts/create', 'Account::create');
$routes->post('accounts/store', 'Account::store');
$routes->get('account', 'Account::showForm');
$routes->post('accounts/show', 'Account::show');
$routes->get('accounts/(:num)/edit', 'Account::edit/$1');
$routes->post('accounts/(:num)/update', 'Account::update/$1');
$routes->post('accounts/(:num)/delete', 'Account::delete/$1');

$routes->get('transactions/withdraw', 'Transactions::withdrawForm');
$routes->post('transactions/withdraw', 'Transactions::withdraw');

$routes->get('transactions/deposit', 'Transactions::depositForm');
$routes->post('transactions/deposit', 'Transactions::deposit');

$routes->get('transactions/balance', 'Transactions::balanceForm');
$routes->post('transactions/balance', 'Transactions::balanceCheck');
$routes->get('transactions/balance/result/(:num)', 'Transactions::balanceResult/$1');

$routes->get('actions', 'Transactions::actionsForm');
$routes->post('actions/show', 'Transactions::listActions');

$routes->get('photo/(:any)', 'Account::servePhoto/$1');





