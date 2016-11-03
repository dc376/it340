<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Reserved routes
$route['default_controller'] = 'dashboard/index';
$route['404_override'] = '';

// Auth stuff
$route['login'] = 'auth/login';
$route['forgot_password'] = 'auth/forgot_password';
$route['reset_password/(:any)'] = 'auth/reset_password/$1';
$route['logout'] = 'dashboard/logout';

// Profile
$route['profile'] = 'dashboard/profile';
$route['profile/password'] = 'auth/change_password';
$route['profile/newkey'] = 'dashboard/newkey';

// Install/enter key
$route['enterkey'] = 'install/enterkey';
$route['enterkey/(:any)'] = 'install/enterkey/$1';

// User section
$route['admin/users/create'] = 'admin/create_user';
$route['admin/users/delete'] = 'admin/delete_user';
$route['admin/users/edit/(:any)'] = 'admin/edit_user/$1';
$route['admin/users/import'] = 'admin/user_import';
$route['admin/users/import/step2'] = 'admin/user_import_step2';
$route['admin/users/import/complete'] = 'admin/user_import_complete';

// Backend API
$route['api/backend/(:any)'] = 'api/backend/index';
$route['api/system/(:any)'] = 'api/system/$1';

// Dashboards
$route['dashboard'] = 'dashboard/show_dash';
$route['index.php/dashboard'] = 'dashboard/show_dash';

// Waiting/Down ... Something to show when elasticsearch isn't up or during elasticsearch restart
$route['waiting'] = 'install/waiting';
$route['down'] = 'install/down';

// Sources...
$route['source-setup'] = 'source/index';
$route['source-setup/windows-files'] = 'source/windows_files';
$route['source-setup/linux-files'] = 'source/linux_files';
$route['source-setup/(:any)'] = 'source/$1';