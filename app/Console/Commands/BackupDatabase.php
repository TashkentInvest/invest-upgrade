<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Laravel\Facades\Telegram;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Backup the database';

    protected $backupPath;

    public function __construct()
    {
        parent::__construct();

        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');
        $this->backupPath = storage_path('app/backups/backup-' . time() . '.sql');

        // Specify the path to mysqldump based on the operating system
        $mysqldumpPath = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'C:\\xampp\\mysql\\bin\\mysqldump.exe' : '/usr/bin/mysqldump';

        if ($password) {
            $command = sprintf('%s -u%s -p%s %s > %s', $mysqldumpPath, $username, $password, $database, $this->backupPath);
        } else {
            $command = sprintf('%s -u%s %s > %s', $mysqldumpPath, $username, $database, $this->backupPath);
        }

        $this->process = Process::fromShellCommandline($command);
    }

    public function handle()
    {
        try {
            $this->process->mustRun();
            $this->info('The backup has been completed successfully.');

            // Send the backup file to Telegram
            $this->sendBackupToTelegram();
        } catch (ProcessFailedException $exception) {
            $this->error('The backup process has failed: ' . $exception->getMessage());
        } catch (\Exception $exception) {
            $this->error('An error occurred: ' . $exception->getMessage());
        }
    }

    protected function sendBackupToTelegram()
    {
        if (!file_exists($this->backupPath)) {
            $this->error('Backup file does not exist.');
            return;
        }

        Telegram::sendDocument([
            'chat_id' => '5676930441',
            'document' => fopen($this->backupPath, 'r'),
            'caption' => 'Backup file'
        ]);

        $this->info('Backup file sent to Telegram successfully.');
    }
}
