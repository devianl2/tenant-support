<?php

namespace Tenant\Support\Traits;

use Illuminate\Http\Request;

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
}
