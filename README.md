# Tenant Support

Tenant support is a laravel package that simplify and focuses on business function development.

For each microservice development, you need to follow instruction below to ensure the application is standardize.

## Step 1:
Install from composer
```sh
composer require devianl2/tenant-support
```

Go to App/Provider/RouteServiceProvider.php and modify rate limit to 600
```sh
protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(600)->by(optional($request->user())->id ?: $request->ip());
        });
    }
```

## Step 2:
Go to laravel project / app / Exceptions / Handler.php and modify from
```sh
class Handler extends ExceptionHandler {
protected $dontReport = [
        //
    ];
    ....
}
```
to
```sh
class Handler extends ExHandler {
// remove all other functions and variables (Exhandler already included all that exceptions)
protected $dontReport = [
        //
    ];
}
```

## Step 3:
All controllers that required API return, use the traits ApiResponse.php. E.g:

```sh
import Tenant\Support\Traits\ApiResponse
class UserController extends Controller {
    use ApiResponse;
}
```

##_functions_
```sh
public function successResponse($data, $statusCode = Response::HTTP_OK)
    {
        return response($data, $statusCode)->header('Content-Type', 'application/json');
    }
    public function errorResponse($errorMessage, $statusCode)
    {
        return response()->json(['error' => $errorMessage, 'error_code' => $statusCode], $statusCode);
    }
    public function errorMessage($errorMessage, $statusCode)
    {
        return response($errorMessage, $statusCode)->header('Content-Type', 'application/json');
    }
```

## Step 4:
All repositories that required paginate, use the traits EloquentPaginate.php. E.g:

```sh
import Tenant\Support\Traits\EloquentPaginate
class UserModel extends Model {
    use EloquentPaginate;
}
```

Sample to use the EloquentPaginate:
```sh
$templates  =   QuestionTemplate::with([
            'sections'
        ]);

        if (array_key_exists('search', $query) && !empty($query['search']))
        {
            $templates =   $templates->where('title', 'LIKE', '%' . $query['search'] .'%');
        }

        return $this->execute($templates, $paginate, $limit);
```
##_params__
1) Query builder is referring eloquent query
2) $paginate is true/false
3) $limit is int (Minimum 1)
