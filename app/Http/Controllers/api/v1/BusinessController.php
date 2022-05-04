<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Http\Resources\BusinessCollection;
use App\Http\Resources\BusinessResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;


class BusinessController extends Controller
{
    protected $page_size;

    public function __construct()
    {
        $this->page_size = config('app.default_pagination_size');
    }

    /**
     * List all businesses
     *
     *
     * @return ResourceCollection
     */
    public function index()
    {
        return new BusinessCollection(Business::enabled()->paginate($this->page_size));
    }

    public function show(int $id)
    {
        try {
            return successResponse(new BusinessResource(Business::whereId($id)->enabled()->firstOrFail()));
        } catch (ModelNotFoundException $exception) {
            Log::error($exception);

            return errorResponse('Business not found!', 404);
        } catch (Throwable $exception) {
            Log::error($exception);

            return errorResponse('Unable to retrieve business information!', $exception->getCode());
        }
    }
}
