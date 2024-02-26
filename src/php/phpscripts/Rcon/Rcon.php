<?php

require "Exceptions/NotAuthenticatedException.php";
require "Exceptions/RconAuthException.php";
require "Exceptions/RconConnectException.php";


class Rcon
{
    const SERVERDATA_AUTH = 3;
    const SERVERDATA_EXECCOMMAND = 2;

    /**
     * The Rcon server IP.
     *
     * @var string
     */
    protected $ip;

    /**
     * The Rcon server port.
     *
     * @var integer
     */
    protected $port;

    /**
     * The Rcon password.
     *
     * @var string 
     */
    protected $password;

    /**
     * The Rcon socket.
     *
     * @var resource 
     */
    protected $socket;

    /**
     * The current packet ID.
     *
     * @var integer 
     */
    protected $packetID;

    /**
     * Is the client connected to the server?
     *
     * @var boolean 
     */
    public $connected = false;

    /**
     * Constructs the Rcon client.
     *
     * @param string $ip
     * @param int $port 
     * @param string $password 
     * @return void 
     */
    public function __construct($ip, $port, $password)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->password = $password;
    }

    /**
     * Connects and authenticates with the CS:GO server.
     *
     * @return boolean 
     */
    public function connect()
{
    $socket = stream_socket_client("tcp://{$this->ip}:{$this->port}", $errno, $errstr);

    stream_set_timeout($socket, 2, 500);

    if (!$socket) {
        throw new RconConnectException("Error while connecting to the Rcon server: {$errstr}");
    }

    $this->socket = $socket;
    $this->stream = $socket; // Adicionando esta linha

    $this->write(self::SERVERDATA_AUTH, $this->password);

    $read = $this->read();
    

    $this->connected = true;

    return true;
}
    /**
     * Sets the timeout on the socket in seconds.
     *
     * @param integer $timeout 
     * @return boolean 
     */
    public function setTimeout($timeout = 2)
    {
        stream_set_timeout($this->stream, $timeout);

        return true;
    }

    /**
     * Executes a command on the server.
     *
     * @param string $command 
     * @return string 
     */
    public function exec($command)
    {
        if (!$this->connected) {
            throw new NotAuthenticatedException('Client has not connected to the Rcon server.');
        }

        $this->write(self::SERVERDATA_EXECCOMMAND, $command);

        return $this->read();
    }

    /**
     * Writes to the socket.
     *
     * @param integer $type
     * @param string $s1
     * @param string $s2 
     * @return integer 
     */
    public function write($type, $s1 = '', $s2 = '')
    {
        $id = $this->packetID++;

        $data  = pack('VV', $id, $type);
        $data .= $s1.chr(0).$s2.chr(0);
        $data  = pack('V', strlen($data)).$data;

        fwrite($this->socket, $data, strlen($data));

        return $id;
    }

    /**
     * Reads from the socket.
     *
     * @return array 
     */
    public function read()
{
    $response = '';
    $rarray = [];
    
    // Definir um tempo limite para a leitura
    $timeout = time() + 5; // 5 segundos
    
    while (time() < $timeout) {
        $data = fread($this->socket, 4096);
        
        if ($data === false || feof($this->socket)) {
            break; // Sai do loop se não houver mais dados para ler
        }
        
        $response .= $data;
        
        // Verifica se a resposta contém um marcador de fim de mensagem
        if (strpos($response, "\n") !== false) {
            // Divide a resposta em linhas
            $lines = explode("\n", $response);
            
            // Processa cada linha da resposta
            foreach ($lines as $line) {
                // Verifica se a linha é vazia
                if (!empty($line)) {
                    // Faz o parsing da linha para extrair os dados relevantes
                    // Divida a linha em partes usando espaços em branco como delimitador
                    $fields = preg_split('/\s+/', $line);
                    // Adicione as partes divididas da linha ao array de resposta
                    $rarray[] = json_encode($fields);
                }
            }
            
            break; // Sai do loop depois de processar todas as linhas da resposta
        }
    }
    
    return $rarray;
}
public function score() {
    $score = fread($this->socket, 4096);

    return $score;
}

    /**
     * Closes the socket.
     *
     * @return boolean 
     */
    public function close()
    {
        if (!$this->connected) {
            return false;
        }

        $this->connected = false;
        fclose($this->socket);

        return true;
    }

    /**
     * Alias for close().
     *
     * @return boolean 
     */
    public function disconnect()
    {
        return $this->close();
    }
}