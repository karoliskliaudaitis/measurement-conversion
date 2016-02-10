<?php

/*---------------------------*/
/*         Constants         */
/*---------------------------*/

// define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/projects/measurement-conversion/");

/*
Using define() with arrays requires PHP 7
Using const with arrays requires PHP 5.6 or higher
*/
const LENGTH_TO_METER = array(
    "inches"         => 0.0254,
    "feet"           => 0.3048,
    "yards"          => 0.9144,
    "miles"          => 1609.344,
    "milimeters"     => 0.001,
    "centimeters"    => 0.01,
    "meters"         => 1,
    "kilometers"     => 1000,
    "acres"          => 63.614907234075, // sqrt(4046.8564224), because we are using pow() function later
    "hectares"       => 100,             // sqrt(10000), because we are using pow() function later
    "nautical_miles" => 1852,            // Used for our speed function convert_speed()
);

const VOLUME_TO_LITER = array(
    "cubic_inches"         => 0.0163871,
    "cubic_feet"           => 28.3168,
    "cubic_centimeters"    => 0.001,
    "cubic_meters"         => 1000,
    "imperial_gallons"     => 4.54609,
    "imperial_quarts"      => 1.13652,
    "imperial_pints"       => 0.568261,
    "imperial_cups"        => 0.284131,
    "imperial_ounces"      => 0.0284131,
    "imperial_tablespoons" => 0.0177582,
    "imperial_teaspoons"   => 0.00591939,
    "us_gallons"           => 3.78541,
    "us_quarts"            => 0.946353,
    "us_pints"             => 0.473176,
    "us_cups"              => 0.24,
    "us_ounces"            => 0.0295735,
    "us_tablespoons"       => 0.0147868,
    "us_teaspoons"         => 0.00492892,
    "liters"               => 1,
    "milliliters"          => 0.001,
);

const MASS_TO_KILOGRAM = array(
    "ounces"        => 0.0283495,
    "pounds"        => 0.453592,
    "stones"        => 6.35029,
    "long_tons"     => 1016.05,
    "short_tons"    => 907.185,
    "milligrams"    => 0.000001,
    "grams"         => 0.001,
    "kilograms"     => 1,
    "metric_tonnes" => 1000,
);



/*---------------------------*/
/*     Helper Functions      */
/*---------------------------*/

function optionize($string) {
    return str_replace(" ", "_", strtolower($string));
}

/*
The function float_to_string formats a float into a string
while also avoiding default use of scientific notation.
Rounds to $precision and trims extra trailing zeros.
 */
function float_to_string($float, $precision=10) {
    // Typecast to insure value is a float
    $float = (float) $float;
    $string = number_format($float, $precision, ".", "");
    $string = rtrim($string, "0"); // Removes every zero from right to left, stops when it gets to something that is not a zero
    $string = rtrim($string, "."); // This decimal gets removed only if there was any zeros before
    return $string;
}



/*---------------------------*/
/*    Length And Distance    */
/*---------------------------*/

function convert_to_meters($value, $from_unit) {
    if (array_key_exists($from_unit, LENGTH_TO_METER)) {
        return $value * LENGTH_TO_METER[$from_unit];
    } else {
        return "Please select unit.";
    }
}

function convert_from_meters($value, $to_unit) {
    if (array_key_exists($to_unit, LENGTH_TO_METER)) {
        return $value / LENGTH_TO_METER[$to_unit];
    } else {
        return "Please select unit.";
    }
}

function convert_length($value, $from_unit, $to_unit) {
    $meter_value = convert_to_meters($value, $from_unit);
    $new_value = convert_from_meters($meter_value, $to_unit);
    if (empty($meter_value)) {
        return "Please enter a value.";
    } else {
        return $new_value;
    }
}



/*---------------------------*/
/*           Area            */
/*---------------------------*/

function convert_to_square_meters($value, $from_unit) {
    $from_unit = str_replace("square_", "", $from_unit);
    if (array_key_exists($from_unit, LENGTH_TO_METER)) {
        return $value * pow(LENGTH_TO_METER[$from_unit], 2);
    } else {
        return "Please select unit.";
    }
}

function convert_from_square_meters($value, $to_unit) {
    $to_unit = str_replace("square_", "", $to_unit);
    if (array_key_exists($to_unit, LENGTH_TO_METER)) {
        return $value / pow(LENGTH_TO_METER[$to_unit], 2);
    } else {
        return "Please select unit.";
    }
}

function convert_area($value, $from_unit, $to_unit) {
    $square_meter_value = convert_to_square_meters($value, $from_unit);
    $new_value = convert_from_square_meters($square_meter_value, $to_unit);
    if (empty($square_meter_value)) {
        return "Please enter a value.";
    } else {
        return $new_value;
    }
}



/*---------------------------*/
/*    Volume And Capacity    */
/*---------------------------*/

function convert_to_liters($value, $from_unit) {
    if (array_key_exists($from_unit, VOLUME_TO_LITER)) {
        return $value * VOLUME_TO_LITER[$from_unit];
    } else {
        return "Please select unit.";
    }
}

function convert_from_liters($value, $to_unit) {
    if (array_key_exists($to_unit, VOLUME_TO_LITER)) {
        return $value / VOLUME_TO_LITER[$to_unit];
    } else {
        return "Please select unit.";
    }
}

function convert_volume($value, $from_unit, $to_unit) {
    $liter_value = convert_to_liters($value, $from_unit);
    $new_value = convert_from_liters($liter_value, $to_unit);
    if (empty($liter_value)) {
        return "Please enter a value.";
    } else {
        return $new_value;
    }
}



/*---------------------------*/
/*      Mass And Weight      */
/*---------------------------*/

function convert_to_kilograms($value, $from_unit) {
    if (array_key_exists($from_unit, MASS_TO_KILOGRAM)) {
        return $value * MASS_TO_KILOGRAM[$from_unit];
    } else {
        return "Please select unit.";
    }
}

function convert_from_kilograms($value, $to_unit) {
    if (array_key_exists($to_unit, MASS_TO_KILOGRAM)) {
        return $value / MASS_TO_KILOGRAM[$to_unit];
    } else {
        return "Please select unit.";
    }
}

function convert_mass($value, $from_unit, $to_unit) {
    $kg_value = convert_to_kilograms($value, $from_unit);
    $new_value = convert_from_kilograms($kg_value, $to_unit);
    if (empty($kg_value)) {
        return "Please enter a value.";
    } else {
        return $new_value;
    }
}



/*---------------------------*/
/*           Speed           */
/*---------------------------*/

function convert_speed($value, $from_unit, $to_unit) {
    // Adding some if statements so our explode() works as it is
    if ($from_unit == "knots") {
        $from_unit = "nautical_miles_per_hour";
    }
    if ($to_unit == "knots") {
        $to_unit = "nautical_miles_per_hour";
    }

    list($from_dist, $from_time) = array_pad(explode("_per_", $from_unit), 2, null); // array_pad() is used to remove a "Notice: undefined offset 1"
    list($to_dist, $to_time) = array_pad(explode("_per_", $to_unit), 2, null);  // array_pad() is used to remove a "Notice: undefined offset 1"

    if ($from_time == "hour") {
        $value = $value / 3600; // 1 hour divided by 3600 seconds (1h = 3600s)
    }
    $value = convert_length($value, $from_dist, $to_dist); // Using our already created function
    if ($to_time == "hour") {
        $value = $value * 3600;
    }

    return $value;
}



/*---------------------------*/
/*        Temperature        */
/*---------------------------*/

function convert_to_celsius($value, $from_unit) {
    switch ($from_unit) {
        case 'celsius':
            return $value;
            break;
        case 'fahrenheit':
            return ($value - 32) / 1.8;
            break;
        case 'kelvin':
            return $value - 273.15;
            break;
        default:
            return "Please select unit.";
    }
}

function convert_from_celsius($value, $to_unit) {
    switch ($to_unit) {
        case 'celsius':
            return $value;
            break;
        case 'fahrenheit':
            return ($value * 1.8) + 32;
            break;
        case 'kelvin':
            return $value + 273.15;
            break;
        default:
            return "Please select unit.";
    }
}

function convert_temperature($value, $from_unit, $to_unit) {
    $celsius_value = convert_to_celsius($value, $from_unit);
    $new_value = convert_from_celsius($celsius_value, $to_unit);
    if (empty($celsius_value) && $celsius_value !== "0") {
        return "Please enter a value.";
    } else {
        return $new_value;
    }
}
