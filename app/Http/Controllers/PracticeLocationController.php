<?php

namespace App\Http\Controllers;

use App\Enums\ResponseStatus;
use App\Http\Requests\FacilityLocationRequest;
use App\Http\Requests\FacilityRequest;
use App\Http\Requests\StatusFacilityLocationRequest;
use App\Http\Requests\StatusFacilityRequest;
use App\Models\Facility;
use App\Models\FacilityLocation;
use App\Service\PracticeLocationService;
use Illuminate\Http\Request;

class PracticeLocationController extends Controller
{
    protected $practiceLocationService;
    public function __construct(PracticeLocationService $practiceLocationService)
    {
        $this->practiceLocationService = $practiceLocationService;
    }

    public function index(Request $request)
    {
        $perPage = $request->get("per_page", 10);
        $page = $request->get("page", 1);
        try {
            $list = Facility::notDeleted()->active()->paginate($perPage);
            return response()->success($list, "success", ResponseStatus::SUCCESS);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function storeFacility(FacilityRequest $request)
    {
        $data = $request->validated();
        try {
            $this->practiceLocationService->storeFacility($data);
            return response()->success(null, "success", ResponseStatus::CREATED);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function findFacility($id)
    {
        try {
            $facility = $this->practiceLocationService->findFacilityWithLocations($id);
            return response()->success($facility, "success", ResponseStatus::CREATED);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function updateFacility(FacilityRequest $request)
    {
        $data = $request->validated();
        try {
            $this->practiceLocationService->updateFacility($data);
            return response()->success(null, "success", ResponseStatus::CREATED);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function statusFacility(StatusFacilityRequest $request)
    {
        $data = $request->validated();
        try {
            Facility::where('id', $data['id'])->update(['is_active'=> $data['is_active']]);
            return response()->success(null, "status updated successfully", ResponseStatus::SUCCESS);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function findLocation($id)
    {
        try {
            $location = $this->practiceLocationService->findLocationWithBillings($id);
            if (!$location) {
                return response()->error("Not Found", ResponseStatus::NOT_FOUND);
            }
            return response()->success($location, "success", ResponseStatus::SUCCESS);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function getLocations(Request $request, $facilityId)
    {
        $perPage = $request->get("per_page", 10);
        $page = $request->get("per_page", 1);
        try {
            $list = FacilityLocation::where('facility_id', $facilityId)->notMain()->notDeleted()->active()->paginate($perPage);
            return response()->success($list, "success", ResponseStatus::SUCCESS);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function addLocation(FacilityLocationRequest $request)
    {
        $data = $request->validated();
        try {
            $this->practiceLocationService->addFacilityLocation($data);
            return response()->success(null, "success", ResponseStatus::CREATED);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function statusFacilityLocation(StatusFacilityLocationRequest $request)
    {
        $data = $request->validated();
        try {
            FacilityLocation::where('id', $data['id'])->update(['is_active'=> $data['is_active']]);
            return response()->success(null, "status updated successfully", ResponseStatus::CREATED);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }
}
