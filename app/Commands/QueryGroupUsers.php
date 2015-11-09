<?php
namespace freeradius\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use freeradius\Freeradius;

class QueryGroupUsers extends Command implements SelfHandling
{
    /**
     *
     * @var \freeradius\Freeradius
     */
    protected $api;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'radius:groupusers {groupname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Search the radius group for user accounts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Freeradius $freeradius)
    {
        parent::__construct();
        $this->api = $freeradius;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $headings = [
            'User ID',
            'Group Name',
            'User Name',
            'NAS IP Address',
            'Session Time',
            'Start Time',
            'End Time',
            'Input Oct',
            'Output Oct',
            'Connection',
        ];
        $data = [];
        foreach ($this->api->queryUserAccounts(['groupname' => $this->argument('groupname')]) as $row) {
            $data[] = $row;
        }
        $this->table($headings, $data);
    }
}
