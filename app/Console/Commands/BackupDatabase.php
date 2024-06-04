<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';

    protected $description = 'Backup the database';

    protected $process;

    public function __construct()
    {
        parent::__construct();

        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');
        $backupPath = storage_path('app/backups/backup-' . time() . '.sql');

        // Specify the path to mysqldump based on the operating system
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Windows path
            $mysqldumpPath = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';
        } else {
            // Linux path
            $mysqldumpPath = '/usr/bin/mysqldump';
        }

        if ($password) {
            $command = sprintf('%s -u%s -p%s %s > %s', $mysqldumpPath, $username, $password, $database, $backupPath);
        } else {
            $command = sprintf('%s -u%s %s > %s', $mysqldumpPath, $username, $database, $backupPath);
        }

        $this->process = Process::fromShellCommandline($command);
    }

    public function handle()
    {
        try {
            $this->process->mustRun();

            $this->info('The backup has been completed successfully.');
        } catch (ProcessFailedException $exception) {
            $this->error('The backup process has failed: ' . $exception->getMessage());
        }
    }
}
