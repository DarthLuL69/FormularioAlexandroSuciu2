<?php

require_once __DIR__ . '/interfaces/IToJson.php';

class User implements IToJson
{
    public $id;
    public $nombre;
    public $apellidos;
    public $contraseña;
    public $telefono;
    public $email;
    public $sexo;
    public $fecha_nacimiento;

    public function __construct(
        $nombre = '',
        $apellidos = '',
        $contraseña = '',
        $telefono = '',
        $email = '',
        $sexo = '',
        $fecha_nacimiento = ''
    ) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->contraseña = $contraseña;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->sexo = $sexo;
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function toJson()
    {
        return json_encode(get_object_vars($this));
    }

    public function create($db)
    {
        $consulta = "INSERT INTO alumno (nombre, apellidos, contraseña, telefono, email, sexo, fecha_nacimiento) 
                  VALUES (:nombre, :apellidos, :contraseña, :telefono, :email, :sexo, :fecha_nacimiento)";
        $stmt = $db->prepare($consulta);
        foreach (get_object_vars($this) as $clave => $valor) {
            $stmt->bindParam(":$clave", $this->$clave);
        }
        return $stmt->execute();
    }

    public function update($db)
    {
        $consulta = "UPDATE alumno SET nombre = :nombre, apellidos = :apellidos, contraseña = :contraseña, telefono = :telefono, email = :email, sexo = :sexo, fecha_nacimiento = :fecha_nacimiento WHERE id = :id";
        $stmt = $db->prepare($consulta);
        foreach (get_object_vars($this) as $clave => $valor) {
            $stmt->bindParam(":$clave", $this->$clave);
        }
        return $stmt->execute();
    }

    public function get($db)
    {
        $consulta = "SELECT * FROM alumno WHERE id = :id";
        $stmt = $db->prepare($consulta);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($db)
    {
        $consulta = "DELETE FROM alumno WHERE id = :id";
        $stmt = $db->prepare($consulta);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>