<?php

namespace App\Http\Controllers;

use App\Enums\ResponseStatus;
use App\Models\BillingRegion;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get("per_page", 10);
        $page = $request->get("page", 1);
        $filter = $request->get("filter", null);
        try {
            $query = BillingRegion::notDeleted();
            $list = $query->orderBy('name', 'ASC')->paginate($perPage);
            return response()->success($list, "success", ResponseStatus::SUCCESS);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }
}
