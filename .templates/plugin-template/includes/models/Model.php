<?php

namespace __templateNameToPascalCase__\Models;


abstract class Model
{
    /**
     * La tabla de la base de datos asociada al modelo.
     * @var string
     */
    protected $table;

    /**
     * Constructor. Establece la tabla asociada al modelo.
     * @param string $table La tabla de la base de datos asociada al modelo.
     */
    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * Obtiene todos los registros de la tabla.
     * @return array Arreglo de objetos que representan los registros de la tabla.
     */
    public abstract function all();

    /**
     * Encuentra un registro por su ID.
     * @param int $id El ID del registro a buscar.
     * @return object|false El objeto que representa el registro encontrado, o false si no se encuentra.
     */
    public abstract function find($id);

    /**
     * Crea un nuevo registro en la tabla.
     * @param array $data Los datos del registro a crear.
     * @return int|false El ID del nuevo registro creado, o false si falla la creación.
     */
    public abstract function create($data);

    /**
     * Actualiza un registro existente en la tabla.
     * @param int $id El ID del registro a actualizar.
     * @param array $data Los nuevos datos del registro.
     * @return bool true si la actualización fue exitosa, false si falla.
     */
    public abstract function update($id, $data);

    /**
     * Elimina un registro de la tabla por su ID.
     * @param int $id El ID del registro a eliminar.
     * @return bool true si la eliminación fue exitosa, false si falla.
     */
    public abstract function delete($id);
}
