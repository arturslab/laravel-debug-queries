<?php

namespace App\Console\Commands\Tutorial;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Class SampleCommand
 * @package App\Console\Commands\Turorial
 */
class SampleCommand extends Command
{
    /**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
    protected $signature = 'tutorial:sample-command';
    
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'This is sample command.';

	/**
	 * Create a new command instance.
	 */
	public function __construct()
	{
		parent::__construct();

    }

	public function handle()
	{
		$dataArray = [];
		$this->debugQueries();
        
        $results = $this->getData();

	}

	/**
	 * @return array|null
	 */
	private function getData(): array
	{

        $res = DB::table('users')->get();

		return isset($res) ? $res->toArray() : [];
    }

	/**
	 * Dump DB queries
	 */
	private function debugQueries() {

		// Show queries
		\DB::listen(function ($sql) {

			try {
				$fullQueryString = vsprintf(str_replace('?', '%s', $sql->sql), collect($sql->bindings)->map(function ($binding) {
					return is_numeric($binding) ? $binding : "'{$binding}'";
				})->toArray());
			} catch (Exception $ex) {
				$fullQueryString = $ex->getMessage();
			}

			dump([
				'QUERY' => $sql->sql,
				'BINDINGS' => $sql->bindings,
				'FULL QUERY STRING' => $fullQueryString,
				'QUERY EXECUTION TIME' => $sql->time,
				'CONNECTION NAME' => $sql->connectionName,
			]);

		});
    }
}