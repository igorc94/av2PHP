<?php
$msgErro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	
    $nome = $_POST["nome"];
    $idS = $_POST["id"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $peso = $_POST["peso"];
    $tipo = $_POST["tipo"];
	$categoria = $_POST["categoria"];
	$fabricante = $_POST["fabricante"];
	$quant = $_POST["quant"];
	$cod = $_POST["codigo"];
	$data = $_POST["data"];
	$ativo= $_POST["ativo"];
	
	$img = $_FILES["files"];
	print_r ( $img );
	
	$formEr = 0;
	
	
	function validaIMG($img,$cod){
		if ( $img == "none" )
		{
			$formEr = 1;
		}
		else{
			$error = 0 ;
			if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $img["type"])){
			   $formEr = 1;
			   $error = 1;
			} 


			
			if ($error == 0) {
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $img["name"], $ext);

				$nome_imagem = $cod . "." . $ext[1];
				
				
				$path = "C:/xampp1/htdocs/3daw/Imagens/" . $nome_imagem;
			
				move_uploaded_file($img["tmp_name"], $path);
				
				return $nome_imagem;
				
			}
		}
	}
    function validatorA($formDado) {
        if ($formDado == "" or ctype_alpha($formDado)) {
            $formInvalido = 1;
        }
    }
	function dateValidator($formDado) {
        $date= DateTime::createFromFormat('y-m-d',$formDado);
		if ($date && $date->format('y-m-d') != $formDado) {
            $formInvalido = 1;
        }
    }
    function DigitValidatort($formDado) {
        if ($formDado == "" or !ctype_digit($formDado)) {
            $formInvalido = 1;
        }
    }
    
	
	$nome_imagem = validaIMG($img,$cod);
	dateValidator($data);
    validatorA($nome);
    DigitValidatort($idS);
    validatorA($fabricante);
	validatorA($disponivel);
	validatorA($categoria);
	validatorA($tipo);
    DigitValidatort($quant);
    validatorA($descricao);
    DigitValidatort($cod);
	DigitValidatort($preco);
	DigitValidatort($peso);
	

    $msgErro = "";
	
    if ($formEr == 0) {
		
        //fazendo conexao com o banco
			$servidor = "localhost";
			$usuario = "root";
			$senha = "";
			$nomebanco= "3dawfaeterj";
			
			
			$conn = new mysqli($servidor,$usuario,$senha,$nomebanco);
			if (!$conn) 
			{
				echo "Erro ao conectar DB. Tente novamente";
			}
			
			$sql = "UPDATE produto SET ID_PROD=$idS,NOME='$nome',CATEGORIA='$categoria',tipo='$tipo',FABRICANTE='$fabricante',COD_BARRA='$cod',
			IMG='$nome_imagem',DESCRICAO='$descricao',PRECO=$preco,PESO=$peso,QUANT_EST=$quant,ATIVO='$ativo',DATA_CADASTRO='$data' WHERE COD_BARRA = '$cod' ";
		
			
			if($resultado = $conn->query($sql))
			{
				echo "Produto atualizado, $nome";
			}
			else 
			{
			  echo "Erro de insercao";
			}
		}
		else
		{
			echo "Formulario contem erros.";
		}
}
?>