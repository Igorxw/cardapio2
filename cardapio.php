<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $total = 0;
    $items = [];
    
    // Produtos e preços
    $products = [
        'X-Burguer' => 8.30,
        'Misto Quente' => 7.00,
        'X-Salada' => 8.90,
        'Fanta' => 5.00,
        'Conquista' => 5.50,
        'Batata Frita' => 10.00,
        'Anéis de Cebola' => 12.00,
        'Brigadeiro' => 2.00,
    ];

    // Processa todos os tipos de itens
    foreach (['lanches', 'bebidas', 'porcoes', 'doces'] as $category) {
        if (!empty($_POST[$category])) {
            foreach ($_POST[$category] as $item) {
                $quantidade = intval($_POST['quantidade_' . strtolower(str_replace(' ', '_', $item))] ?? 0);
                if ($quantidade > 0) {
                    $items[] = "$quantidade x $item";
                    $total += $quantidade * $products[$item];
                }
            }
        }
    }

    // Observações
    $observacao = $_POST['observacao'] ?? '';

    // Exibe o resultado
    echo "<h1>Resumo do Pedido</h1><ul>";
    foreach ($items as $item) {
        echo "<li>$item</li>";
    }
    echo "</ul><h2>Valor Total: R$ " . number_format($total, 2, ',', '.') . "</h2>";
    if ($observacao) {
        echo "<h3>Observações:</h3><p>$observacao</p>";
    }
}
?>
