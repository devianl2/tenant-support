<?php

namespace Tenant\Support\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

trait TenantSupport
{

    /**
     * Get tenantId
     * @return string
     */
    public function getTenantId(Request $request)
    {
        //tenant-auth package will validate it
        if ($request->has('tenantId') && !empty($request->input('tenantId')))
        {
            $tenantId  =   $request->input('tenantId'); // One tenant id per selection
        }
        else
        {
            $tenantId    =   $request->header('x-tenant-uuid'); // default is origin tenant id
        }

        return $tenantId;
    }

    /**
     * Return current request token
     * @param Request $request
     * @return array|string|null
     */
    public function getBearerToken(Request $request)
    {
        if ($request->hasHeader('Authorization') &&
            !empty($request->header('Authorization'))
        )
        {
            return $request->header('Authorization');
        }
        else
        {
            if (Cookie::has('Authorization'))
            {
                return Cookie::get('Authorization');
            }
        }

        return null;
    }
}
