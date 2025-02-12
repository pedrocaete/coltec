<?php
function calculateProducts($vector1, $vector2)
{
    // Verificar se os vetores têm 3 elementos cada
    if (count($vector1) != 3 || count($vector2) != 3) {
        throw new Exception("Os vetores devem ter 3 elementos cada");
    }

    // Calcular o produto vetorial
    $crossProduct = array(
        $vector1[1] * $vector2[2] - $vector1[2] * $vector2[1],
        $vector1[2] * $vector2[0] - $vector1[0] * $vector2[2],
        $vector1[0] * $vector2[1] - $vector1[1] * $vector2[0]
    );

    // Calcular o produto escalar
    $dotProduct = $vector1[0] * $vector2[0] + $vector1[1] * $vector2[1] + $vector1[2] * $vector2[2];

    return array("crossProduct" => $crossProduct, "dotProduct" => $dotProduct);
}

$vector1 = array(1, 2, 3);
$vector2 = array(4, 5, 6);

$result = calculateProducts($vector1, $vector2);

echo "Produto vetorial: (" . $result["crossProduct"][0] . ", " . $result["crossProduct"][1] . ", " . $result["crossProduct"][2] . ")" . "<br>";
echo "Produto escalar: " . $result["dotProduct"] . "<br>";
