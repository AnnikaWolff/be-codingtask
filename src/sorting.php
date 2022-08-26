<?php

function sortByKey(array $objects, string $key): array
{
    usort($objects, fn (array $a, array $b): int =>
    $a[$key] <=> $b[$key]
        ?: $a['type'] > $b['type']
    );

    return $objects;
}


$file = file_get_contents("docs/objekte.json");
try {
    $data = json_decode($file, true, 512, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
    die("could not decode json data: " . $e->getMessage());
}

foreach ($data as $k => $d) {
    if ($d['promotionPrice'] > 0) {
        $sortProms[] = $d;
    } else {
        $sortPrices[] = $d;
    }
}

$sorted = sortByKey($sortProms, 'promotionPrice');
array_push($sorted, ...sortByKey($sortPrices, 'price'));



print("\n### Ausgangsdaten ###\n\n");
print_r($data);
print("\n\n### Resultat ###\n\n");
print_r($sorted);

