<?php

namespace App\Service;

use App\Enums\ResponseStatus;
use App\Interface\FacilityBillingRepositoryInterface;
use App\Interface\FacilityLocationRepositoryInterface;
use App\Interface\FacilityRepositoryInterface;
use App\Interface\FacilityTimingRepositoryInterface;
use App\Models\FacilityLocation;
use Carbon\Carbon;

class PracticeLocationService
{

    protected $facilityRepository;
    protected $facilityLocationRepository;
    protected $facilityBillingRepository;
    protected $facilityTimingRepository;
    public function __construct(
        FacilityRepositoryInterface $facilityRepository,
        FacilityLocationRepositoryInterface $facilityLocationRepository,
        FacilityBillingRepositoryInterface $facilityBillingRepository,
        FacilityTimingRepositoryInterface $facilityTimingRepository
    ) {
        $this->facilityRepository = $facilityRepository;
        $this->facilityLocationRepository = $facilityLocationRepository;
        $this->facilityBillingRepository = $facilityBillingRepository;
        $this->facilityTimingRepository = $facilityTimingRepository;
    }

    public function storeFacility($data)
    {
        // dd($data);
        $location = $data["location"];
        $billing = $location['billing'] ?? null;
        unset($location['billing']);

        $facility = $this->facilityRepository->create([
            "name" => $data["name"],
            "qualifier" => $data["sh_name"],
            "generate_document_using" => $data['pdf_type'],
        ]);

        $facilityLocation = $this->storeLocation($location + [
            "facility_id" => $facility->id,
        ]);

        $this->storeBillig($billing + [
            "facility_location_id" => $facilityLocation->id
        ]);
    }

    public function findFacilityWithLocations($id)
    {
        $facility = $this->findFacility($id);
        if (empty($facility)) {
            throw new \Exception("Not Found", ResponseStatus::NOT_FOUND);
        }
        $facility->location = FacilityLocation::with(['billing' => function ($query) {
            $query->notDeleted();
        }])->where("facility_id", $facility->id)->main()->notDeleted()->get();
        return $facility;
    }

    public function findFacility($id)
    {
        return $this->facilityRepository->find($id);
    }

    public function updateFacility($data)
    {
        $location = $data["location"];
        $billing = $location['billing'] ?? null;
        unset($location['billing']);

        if (!$data['id']) {
            throw new \Exception('Not Found', ResponseStatus::NOT_FOUND);
        }

        $facility = $this->facilityRepository->update($data['id'], [
            "name" => $data["name"],
            "qualifier" => $data["sh_name"],
            "generate_document_using" => $data['pdf_type'],
        ]);

        $facilityLocation = $this->storeLocation($location + [
            "facility_id" => $data['id'],
        ]);

        $this->storeBillig($billing + [
            "facility_location_id" => $facilityLocation->id
        ]);
    }

    public function addFacilityLocation($data)
    {
        $timings = $data['timings'];
        $time = $data['time_zone'];
        unset($data['timings']);

        $facilityLocation = $this->storeLocation($data);

        $dayIds = collect($timings)->pluck('day_id')->toArray();

        $this->facilityTimingRepository->deleteByConditionals($facilityLocation->id, $dayIds);

        foreach ($timings as $key => $timing) {
            $this->facilityTimingRepository->createOrUpdate($timing + [
                'facility_location_id' => $facilityLocation->id,
                "time_zone" => $time['time_zone'],
                "time_zone_string" => $time['time_zone_string'],
                "start_time" => Carbon::parse($timing['start_time'])->addMinutes($time['time_zone'])->format('H:i:s'),
                "end_time" => Carbon::parse($timing['start_time'])->addMinutes($time['time_zone'])->format('H:i:s'),
                "start_time_isb" => $timing['start_time'],
                "end_time_isb" => $timing['end_time'],
            ]);
        }
    }

    public function storeLocation($data)
    {
        $id = $data['id'] ?? null;
        unset($data['id']);
        return $this->facilityLocationRepository->createOrUpdate($id, $data);
    }

    public function storeBillig($data)
    {
        $id = $data['id'] ?? null;
        unset($data['id']);
        return $this->facilityBillingRepository->createOrUpdate($id, $data);
    }

    public function findLocationWithBillings($id)
    {
        return FacilityLocation::with(['timing' => function ($query) {
            $query->notDeleted();
        }])->where('id', $id)->first();
    }
}
