<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetBD extends Command
{
    protected $signature = 'resetbd';
    protected $description = 'Ejecuta migrate:rollback, migrate y db:seed en un solo comando';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->call('migrate:rollback');
        $this->info(' - ROLLBACK resetbd ejecutado exitosamente.');

        $this->call('migrate');
        $this->info(' - MIGRATE resetbd ejecutado exitosamente.');

        $this->call('db:seed');
        $this->info(' - SEED resetbd ejecutado exitosamente.');
    }
}
