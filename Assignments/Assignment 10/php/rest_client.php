<?php

function getWeather()
{
    $acknowledgement = "";
    $output = "";

    $zip = "";
    if (isset($_POST["zip_code"])) {
        $zip = trim($_POST["zip_code"]);
    }

    $url = "https://russet-v8.wccnet.edu/~sshaper/assignments/assignment10_rest/get_weather_json.php?zip_code=" . urlencode($zip);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        $acknowledgement = "<p class='mt-3 text-danger'>There was an error contacting the weather service.</p>";
        curl_close($ch);
        return array($acknowledgement, $output);
    }

    curl_close($ch);

    $data = json_decode($response, true);

    if ($data === null) {
        $acknowledgement = "<p class='mt-3 text-danger'>There was an error reading the data.</p>";
        return array($acknowledgement, $output);
    }

    if (isset($data["error"])) {
        $acknowledgement = "<p class='mt-3 text-danger'>" . htmlspecialchars($data["error"]) . "</p>";
        return array($acknowledgement, $output);
    }

    if (!isset($data["searched_city"])) {
        $acknowledgement = "<p class='mt-3 text-danger'>The data that came back was missing the city.</p>";
        return array($acknowledgement, $output);
    }

    $city = $data["searched_city"];

    $cityName = isset($city["name"]) ? htmlspecialchars($city["name"]) : "Unknown city";
    $temp = isset($city["temperature"]) ? $city["temperature"] : "";
    $humidity = isset($city["humidity"]) ? htmlspecialchars($city["humidity"]) : "";

    $output .= "<h2 class='mt-4'>$cityName</h2>";
    $output .= "<p><strong>Temperature:</strong> $temp</p>";
    $output .= "<p><strong>Humidity:</strong> $humidity</p>";

    $output .= "<p><strong>3 day forecast</strong></p>";

    if (isset($city["forecast"]) && is_array($city["forecast"]) && count($city["forecast"]) > 0) {
        $output .= "<ul>";
        foreach ($city["forecast"] as $row) {
            $day = htmlspecialchars($row["day"]);
            $cond = htmlspecialchars($row["condition"]);
            $output .= "<li>$day: $cond</li>";
        }
        $output .= "</ul>";
    } else {
        $output .= "<p>No forecast data found.</p>";
    }

    $higher = array();
    if (isset($data["higher_temperatures"]) && is_array($data["higher_temperatures"])) {
        $higher = $data["higher_temperatures"];
    }

    $output .= "<p class='mt-4'><strong>Up to three cities where temperatures are higher than $cityName</strong></p>";

    if (count($higher) == 0) {
        $output .= "<p>There are no cities with temperatures higher than $cityName.</p>";
    } else {
        $output .= "<table class='table table-striped'>";
        $output .= "<thead><tr><th>City Name</th><th>Temperature</th></tr></thead><tbody>";
        $count = 0;
        foreach ($higher as $h) {
            if ($count >= 3) {
                break;
            }
            $hName = htmlspecialchars($h["name"]);
            $hTemp = $h["temperature"];
            $output .= "<tr><td>$hName</td><td>$hTemp</td></tr>";
            $count++;
        }
        $output .= "</tbody></table>";
    }

    $lower = array();
    if (isset($data["lower_temperatures"]) && is_array($data["lower_temperatures"])) {
        $lower = $data["lower_temperatures"];
    }

    $output .= "<p class='mt-4'><strong>Up to five cities where temperatures are lower than $cityName</strong></p>";

    if (count($lower) == 0) {
        $output .= "<p>There are no cities with temperatures lower than $cityName.</p>";
    } else {
        $output .= "<table class='table table-striped'>";
        $output .= "<thead><tr><th>City Name</th><th>Temperature</th></tr></thead><tbody>";
        $count = 0;
        foreach ($lower as $l) {
            if ($count >= 5) {
                break;
            }
            $lName = htmlspecialchars($l["name"]);
            $lTemp = $l["temperature"];
            $output .= "<tr><td>$lName</td><td>$lTemp</td></tr>";
            $count++;
        }
        $output .= "</tbody></table>";
    }

    return array($acknowledgement, $output);
}
