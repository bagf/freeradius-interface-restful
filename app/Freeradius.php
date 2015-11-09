<?php
namespace freeradius;

use Config;
use DB;

class Freeradius
{
    protected $config;

    public function __construct()
    {
        $this->config = Config::get('freeradius.sql');
    }

    protected function constraints($query, $params = [])
    {
        $params = array_filter($params, function ($entry) {
            return !is_null($entry);
        });
        foreach ($params as $param => $value) {
            $query = $query->where($param, $value);
        }
        return $query;
    }
    
    protected function isConnected($connectTime, $disconnectTime)
    {
        if (is_null($connectTime)) {
            return false;
        }
        if (is_null($disconnectTime)) {
            return true;
        }
        return (strtotime($connectTime) > strtotime($disconnectTime));
    }

    public function queryUserAccounts($params)
    {
        $query = $this->constraints(DB::table($this->config['acct_table1']), $params);
        
        foreach ($query->get() as $entry) {
            yield [
                'user_id' => $entry->radacctid,
                'groupname' => $entry->groupname,
                'username' => $entry->username,
                'nasipaddress' => $entry->nasipaddress,
                'acctsessiontime' => $entry->acctsessiontime,
                'acctstarttime' => $entry->acctstarttime,
                'acctstoptime' => $entry->acctstoptime,
                'acctinputoctets' => $entry->acctinputoctets,
                'acctoutputoctets' => $entry->acctoutputoctets,
                'connectionstatus' => $this->isConnected($entry->acctstarttime, $entry->acctstoptime)?'connected':'disconnected',
            ];
        }
    }
}
