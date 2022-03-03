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

host('dev')
    ->set('hostname', 'sc4damienv.universe.wf')
    ->set('remote_user', 'sc4damienv')
    ->set('deploy_path', '~/sc4damienv')
    ->set('branch', 'main')
    ->set('composer_options', '--verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader')
    ->set('ssh_multiplexing', true)
    ->set('environment', 'dev')
    ->set('git_ssh_command', 'ssh')
;

// Run migrations before enabling the release
before('deploy:symlink', 'database:migrate');

// Unlock deployer when deployment fails
after('deploy:failed', 'deploy:unlock');
