<?php

/**
 * @param array
 * 
 * @return array
 */
function sortIntervales(array $intervales): array {
    usort($intervales, fn($a, $b) => $a[0] <=> $b[0]);
    $newIntervalle = array();
    array_push($newIntervalle, $intervales[0]);
    $index = 0;
    foreach ($intervales as &$intervale) {
        if ($intervale[1] > $newIntervalle[$index][1] && $intervale[0] <= $newIntervalle[$index][1]) {
            $newIntervalle[$index][1] = $intervale[1];
        } else if ($intervale[1] > $newIntervalle[$index][1] && $intervale[0] > $newIntervalle[$index][1]) {
            $newIntervalle[] = $intervale;
            $index++;
        }
    }

    return $newIntervalle;
}

/**
 * @param array
 */
function printArray(array $intervales): void {
    $results = sortIntervales($intervales);
    echo "[";
    foreach ($results as $key => &$result) {
        echo "[".$result[0].", ".$result[1]." ]";
        if ($key !== array_key_last($results)) {
            echo ', ';
        }
    }
    echo "]";
    echo "\n";
}

$tests = [
    [[0, 3], [6, 10]],
    [[0, 5], [3, 10]],
    [[0, 5], [2, 4]],
    [[7, 8], [3, 6], [2, 4]],
    [[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]]
];

if (empty($tests)) {
    print("les données de test sont vides\n");
}
foreach ($tests as $key => $test) {
    if (empty($test)) {
        echo "le tableau a l'index ".$key." est vide\n";
    } else {
        printArray($test);
    }
}
