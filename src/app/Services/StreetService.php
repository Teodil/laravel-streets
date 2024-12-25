<?php

namespace App\Services;

use App\Repositories\RegionRepository;
use App\Repositories\StreetRepository;
use stdClass;

class StreetService {
    protected StreetRepository $streetRepository;
    protected RegionRepository $regionRepository;

    public function __construct(StreetRepository $streetRepository, RegionRepository $regionRepository){
        $this->streetRepository = $streetRepository;
        $this->regionRepository = $regionRepository;
    }

    public function all(){
        return $this->streetRepository->all();
    }

    public function allGroupedByRegions(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->regionRepository->allWithChild();
    }

    public function findByQueryGroupedByRegions($query): array
    {
        $streets = $this->streetRepository->findByQueryWithParentName($query);
        $groupedStreets = $streets->groupBy([
            function ($street) {
                return $street->city->region->id . '|' . $street->city->region->name;
            },
            function ($street) {
                return $street->city->id . '|' . $street->city->name;
            }
        ]);
        $result = []; // Итоговый результат будет массивом объектов
        foreach ($groupedStreets as $regionKey => $cities) {
            [$regionId, $regionName] = explode('|', $regionKey);

            // Создаем объект для региона
            $regionData = new stdClass();
            $regionData->id = (int)$regionId;
            $regionData->name = $regionName;
            $regionData->cities = []; // Массив городов

            foreach ($cities as $cityKey => $streets) {
                [$cityId, $cityName] = explode('|', $cityKey);

                // Создаем объект для города
                $cityData = new stdClass();
                $cityData->id = (int)$cityId;
                $cityData->name = $cityName;
                $cityData->streets = []; // Массив улиц

                foreach ($streets as $street) {
                    // Создаем объект для улицы
                    $streetData = new stdClass();
                    $streetData->id = $street->id;
                    $streetData->name = $street->name;

                    // Добавляем улицу в город
                    $cityData->streets[] = $streetData;
                }

                // Добавляем город в регион
                $regionData->cities[] = $cityData;
            }

            // Добавляем регион в итоговый результат
            $result[] = $regionData;
        }
        //die($groupedStreets);
        return $result;
    }
}
