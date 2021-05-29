<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'abbreviation', 'value'];

    /**
     * Get reference info
     *
     * @param string $category
     * @param string $abbreviation
     * @return mixed
     */
    private static function get(string $category, string $abbreviation)
    {
        return self::where('category', $category)->where('abbreviation', $abbreviation)->first()->value;
    }

    /**
     * Get location reference info
     *
     * @param string $iataCode
     * @return mixed
     */
    public static function getLocation(string $iataCode)
    {
        return self::get('locations', $iataCode);
    }

    /**
     * Get Aircraft reference info
     *
     * @param string $aircraftCode
     * @return mixed
     */
    public static function getAircraftName(string $aircraftCode)
    {
        return self::get('aircraft', $aircraftCode);
    }

    /**
     * Get Carrier reference info
     *
     * @param string $iataCode
     * @return mixed
     */
    public static function getCarrier(string $iataCode)
    {
        return self::get('carriers', $iataCode);
    }

    /**
     * Get currency reference info
     *
     * @param string $currencyCode
     * @return mixed
     */
    public static function getCurrency(string $currencyCode)
    {
        return self::get('currencies', $currencyCode);
    }

    /**
     * Update references
     *
     * @param $dictionaries
     */
    public static function updater($dictionaries): void
    {
        foreach ($dictionaries as $subject => $dictionary) {
            foreach ($dictionary as $abbreviation => $item) {
                switch ($subject) {
                    case 'locations':
                        self::updateOrCreate(
                            ['category' => 'locations', 'abbreviation' => $abbreviation],
                            ['value' => $item->countryCode . ' ' . $item->cityCode]
                        );
                        break;
                    default:
                        self::updateOrCreate(
                            ['category' => $subject, 'abbreviation' => $abbreviation],
                            ['value' => $item]
                        );
                        break;
                }
            }
        }
    }
}
