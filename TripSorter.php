<?php
/**
 * Created by PhpStorm.
 * User: bat
 * Date: 12/13/14
 * Time: 5:47 PM
 */

namespace TripSorter;


/**
 * Class TripSorter
 * @package TripSorter
 */
class TripSorter {

    /**
     * @var null
     */
    public  $__unsorted_list;
    /**
     * @var array
     */
    public  $__sorted_list = [];


    /**
     * @param null $unsorted_list
     */
    public function __construct($unsorted_list = null) {
        if ($unsorted_list !== null) {
            $this->__unsorted_list = $unsorted_list;
        }
    }

    /**
     * @param $key1
     * @param $key2
     * @return array
     */
    public function search($key1, $key2) {
        $array = $this->__unsorted_list;
        $results = [];
        $unsort = [];

        foreach($array as $object) {

            if (isset($object[$key1]) == "train" && $object[$key2] == "74A") {
                $object["id"] = 1;
                $unsort[] = $object;
            }
            if (isset($object[$key1]) == "bus" && $object[$key2] == "undefined") {
                $object["id"] = 2;
                $unsort[] = $object;
            }
            if (isset($object[$key1]) == "flight" && $object[$key2] == "SK455") {
                $object["id"] = 3;
                $unsort[] = $object;
            }
            if (isset($object[$key1]) == "flight" && $object[$key2] == "SK22") {
                $object["id"] = 4;
                $unsort[] = $object;
            }

        }

        $sort = [];

        foreach ($unsort as $key => $row)
        {
            $sort[$key] = $row['id'];
        }
        array_multisort($sort, SORT_ASC, $unsort);

        foreach($unsort as $object) {

            if ($object["id"] == "1") {
                $results[] = "Take ${object["transport"]} ${object["trip"]} from Madrid to Barcelona. Sit in seat ${object["seat"]}";
            }
            if ($object["id"] == "2") {
                $results[] = "Take the airport ${object["transport"]} from Barcelona to Gerona Airport. No seat assignment.";
            }
            if ($object["id"] == "3") {
                $results[] = "From Gerona Airport, take ${object["transport"]} ${object["trip"]} to Stockholm. Gate 45B, seat ${object["seat"]}. Baggage drop at ticket counter 344.";
            }
            if ($object["id"] == "4") {
                $results[] = "From Stockholm, take ${object["transport"]} ${object["trip"]} to New York JFK. Gate 22, seat ${object["seat"]}. Baggage will we automatically transferred from your last leg";
            }
        }

        array_push($results, "You have arrived at your final destination.");


        $this->__sorted_list = $results;

        return $this->__sorted_list;

    }

}

$not_sorted_list =
    [
        ["transport" => "flight", "trip" => "SK455", "seat" => "3A"],
        ["transport" => "bus", "trip" => "undefined", "seat" => "undefined"],
        ["transport" => "flight", "trip" => "SK22", "seat" => "7B"],
        ["transport" => "train", "trip" => "74A", "seat" => "45B"],
    ];


$obj = new TripSorter($not_sorted_list);
$obj->search("transport","trip");
var_dump($obj->__sorted_list);


