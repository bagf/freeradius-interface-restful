<?php

namespace freeradius\Http\Controllers;

use Illuminate\Http\Request;

use freeradius\Http\Requests;
use freeradius\Http\Controllers\Controller;
use freeradius\Http\Requests\UserAccountsRequest;
use freeradius\Freeradius;

class APIController extends Controller
{
    /**
     *
     * @var \freeradius\Freeradius
     */
    protected $api;
    
    public function __construct(Freeradius $api)
    {
        $this->api = $api;
    }
    
    public function getAccounts(UserAccountsRequest $request)
    {
        return response()->json([ 
            'accounts' => $this->api->queryUserAccounts($request->all())
        ]);
    }
}
