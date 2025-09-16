<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Exercicio 1 (Intermediário) - Raul Marques Serrano</title>
</head>
<body>

    <!-- CSS -->
    <style>
    * {
        padding: 3px 20px;
    }
    label {
        margin: -20px;
    }
    input[type="number"] {
        margin-bottom: 10px;
        border-radius: 10px;
    }
    button {
        margin-top: 10px;
        border-radius: 10px;
        background-color: green;
    }
    .matriz {
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }
    </style>

    <!-- PHP -->
    <?php
    # Primeiro form
    echo '
    <hr>
    <h1>FORMULÁRIO:</h1>
    <h6>O prograna criará uma matriz, com o tamanho descrito abaixo pelo usuário, o valor de cada endereço será definido por um numero aleatorio que varia de acordo com a quantidade de espaços na matriz dividido por dois.</h6>
    <form action="" method="post">
    <label for="linha_input">Linha (5-30)</label> <br>
    <input type="number" min="5" max="30" id="linha_input" name="linha" required> <br>
    <label for="coluna_input">Coluna (5-30)</label> <br>
    <input type="number" min="5" max="30" id="coluna_input" name="coluna" required> <br>
    <button >Criar Tabela</button>
    </form>
    <hr>';

    if(isset($_POST['linha']) && isset($_POST['coluna'])) {
        $linha = (int)$_POST['linha'];
        $coluna = (int)$_POST['coluna'];
        $valor_maximo = round($linha*$coluna/2, 0, PHP_ROUND_HALF_DOWN);

        # Segundo form
        echo '
        <form action="" method="post">
        <input type="hidden" name="linha" value="'. $linha .'">
        <input type="hidden" name="coluna" value="'. $coluna .'">';

        for($i = 0; $i != 5; $i++) {
            echo '
            <label for="numero_procurar_input">Procurar '. $i+1 .'º número (0-'. round($valor_maximo, 0, PHP_ROUND_HALF_DOWN) .')</label> <br>
            <input type="number" min="1" max="'. $valor_maximo .'" id="numero'. $i+1 .'_procurar_input" name="numero'. $i+1 .'" required> <br>
            ';
        }

        echo '<button >Buscar Número</button>
        </form>
        <hr>';

        # Declarando todos os numeros que serão buscados
        # Não é nescessário fazer um && para cada post de numero, já que todos tem required, ao receber um, todos também são
        if(isset($_POST['numero1'])) {
            for($i = 1; $i <= 5; $i++) {
                $campo = "numero$i";
                if(isset($_POST[$campo])) {
                    $numero[$i-1] = $_POST[$campo];
                }
            }

            # Criando e printando a Matriz
            echo '
            <h1>MATRIZ:</h1>
            <div class="matriz">
            <table>';
            for($l = 0; $l < $linha; $l++) {
                echo '<tr>';
                for($c = 0; $c < $coluna; $c++) {
                    $matriz[$l][$c] = rand(0, $valor_maximo);
                    echo '<th>'. $matriz[$l][$c]. '</th>';
                }
                echo '</tr>';
            }
            echo '</table>
            </div>
            <hr>';
            
            # Procurando o número desejado
            echo '<h1>VALORES E SUAS PRIMEIRAS APARIÇÕES:</h1><ul>';
            for($i = 0; $i != 5; $i++) {
                # ne = numero encontrado
                $ne[$i] = false;
                for($l = 0; $l < $linha; $l++) {
                    for($c = 0; $c < $coluna; $c++) {
                        if($matriz[$l][$c] == $numero[$i] && !$ne[$i]){
                            echo '<li>Valor '. $numero[$i]. ' encontrado na '. $l+1 .'º linha e '. $c+1 .'º coluna</li>';
                            $ne[$i] = true;
                        }
                    }
                }
                if(!$ne[$i]) {
                    echo '<li>valor '. $numero[$i]. ' não encontrado';
                }
            }
            echo '</ul> <hr>';
        }
    }   
    ?>

</body>
</html>
