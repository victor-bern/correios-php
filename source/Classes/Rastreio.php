<?php

namespace Source\Classes;

class Rastreio
{
    private $object;

    public function __construct(string $object = null)
    {
        $this->object = $object;
    }

    /**
     * @param string|null $object
     */
    public function setObject(?string $object): void
    {
        $this->object = $object;
    }

    public function getObjectInfo()
    {
        try {
            $data = file_get_contents(API_URL . $this->object);
            if (strstr($data, "Erro")) {
                Message::add(["Erro" => "Objeto não encontrado"]);
                throw new \Exception("Objeto não encontrado");
            }
            return json_decode($data);
        } catch (\Exception $exception) {
            header("location: index.php");
            echo $exception->getMessage();
            return null;
        }
    }
}