<?php
return [
    'sql' => [
        /*
         * If you want both stop and start records logged to the
         * same SQL table, leave this as is.  If you want them in
         * different tables, put the start table in acct_table1
         * and stop table in acct_table2
         */
        'acct_table1' => 'radacct',
        /**
         * @todo unused
         */
        'acct_table2' => 'radacct',
        /*
         * Allow for storing data after authentication
         */
        'postauth_table' => 'radpostauth',
        /*
         * Tables containing 'check' items
         */
        'authcheck_table' => 'radcheck',
        'groupcheck_table' => 'radgroupcheck',
        /*
         * Tables containing 'reply' items
         */
        'authreply_table' => 'radreply',
        'groupreply_table' => 'radgroupreply',
        /*
         * Table to keep group info
         */
        'usergroup_table' => 'radusergroup',
    ],
];
