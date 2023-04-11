<?php 

class Contato {

    private $nome = '';
    private $telefone = '';

    private static $contatodor = 0;

    public function __construct( $nome, $telefone ) {
        $this->setNome( $nome );
        $this->setTelefone( $telefone );

        echo 'Criado: ', $this->formatar(), PHP_EOL;
    
        self::$contatodor++;
    }

    public function __destruct() {
        echo 'Destruindo: ', $this->formatar(), PHP_EOL;
        self::$contatodor--;
    }

    public static function getContador() {
        return self::$contatodor;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome( $valor ) {
        $tamanho = mb_strlen( $valor );

        if ( $tamanho >= 2 && $tamanho <= 100 ) {
            $this->nome = $valor;
            return;
        }

        echo 'Formato invalido';
       
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone( $valor ) {
        $tamanho = mb_strlen( $valor );

        if ( is_numeric( $valor ) && $tamanho >= 8 && $tamanho <= 100 ) {
            $this->nome =  $valor;
            return;
        }

        echo 'Formato invalido';
        
    }

    public function formatar() {
        return $this->getNome() . ' - ' . $this->getTelefone();
    }

}

class ContatoProfissional extends Contato {

    private $email = '';

    public function __construct( $nome, $telefone, $email ) {
        parent::__construct( $nome, $telefone );
        $this->setEmail( $email );
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail( $valor ) {
        $tamanho = mb_strlen( $valor );

        $indice = mb_strpos( $valor, '@' );

        if( $indice ==! false && $indice ==! 0 && $indice !== ( $tamanho - 1 ) ) {
            $this->email = $valor;
            return;
        }

        echo 'Email invalido';
    }

    public function formatar() {
        return parent::formatar() . ' - ' . $this->getEmail();
    }
}

echo Contato::getContador(), 'instâncias', PHP_EOL;

// $c = new Contato( 'Eu', '123456789' );
// $c1 = new Contato( 'Ana', '123456789' );

$cont = new ContatoProfissional( 'Bia', '1212121212', 'bia@email.com' );
// echo 'Contato: ', $c->getNome(), ' - ', $c->getTelefone(), PHP_EOL;

?>