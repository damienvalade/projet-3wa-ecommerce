<?php
namespace Deployer;

require 'recipe/symfony.php';

// Config
define('APP_NAME', 'Shoppy');

// Git repository
set('repository', 'git@github.com:damienvalade/projet-3wa-ecommerce.git');

// Number of releases to keep
set('keep_releases', 3);

// Shared directories
set('shared_dirs', [
    'var/log'
]);

// Writable directories
set('writable_dirs', [
    'var'
]);

set('shared_files', [
    '.htaccess'
]);

host('dev')
    ->set('hostname', '51.254.32.246')
    ->set('remote_user', 'damienv')
    ->set('deploy_path', '/var/www/damienvalade/')
    ->set('branch', 'feature/cd')
    ->set('composer_options', '--verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader')
    ->set('ssh_multiplexing', true)
    ->set('environment', 'dev')
    ->set('git_ssh_command', 'ssh')
;

// Unlock deployer when deployment fails
after('deploy:failed', 'deploy:unlock');
