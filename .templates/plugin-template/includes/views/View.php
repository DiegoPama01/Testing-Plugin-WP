<?php

namespace __templateNameToPascalCase__\Views;




abstract class View 
{
    protected $params;
    protected $parent;
    protected $childs;

    /**
     * Constructor for the View class.
     *
     * @param array $params The parameters for the view.
     */
    public function __construct($params = [], $parent = null)
    {
        $this->params = $params;
        $this->parent = $parent;
        $this->childs = array();
    }

    /**
     * Create a child view of this view.
     *
     * @param string $class The class name of the child view.
     * @param array $params The parameters for the child view (default empty array).
     * @return View|null The created child view, or null if the class does not exist or does not extend View.
     */
    public function createChild($class, $params = [])
    {
        if (!class_exists($class) || !is_subclass_of($class, '__templateNameToPascalCase__\Views\View')) {
            return null;
        }
        $child =  new $class($params, $this);
        $this->childs[] = $child;
        return $child;
    }


    /**
     * Envía un mensaje al View padre.
     * 
     * @param string $methodName El nombre del método que se llamará en el padre.
     * @param array $params Los parámetros que se pasarán al método del padre (opcional).
     * @return mixed El resultado de llamar al método del padre, o null si no se puede enviar el mensaje.
     */
    public function sendToParent($methodName, $params = [])
    {
        // Verificar si el padre y el método están definidos
        if (!isset($this->parent) || !method_exists($this->parent, $methodName)) {
            return null; // No se puede enviar el mensaje si el padre o el método no están definidos
        }
        
        // Llamar al método del padre y pasarle los parámetros
        return call_user_func_array([$this->parent, $methodName], $params);
    }

    /**
     * Abstract method to render the view.
     */
    abstract public function render();

    /**
     * Add parameters to the view.
     *
     * @param array $additionalParams The additional parameters to add.
     */
    public function addParams($params)
    {
        $this->params = array_merge($this->params, $params);
    }

    /**
     * Delete parameters from the view.
     *
     * @param array $keysToRemove The names of the parameters to remove.
     */
    public function deleteParams($params)
    {
        foreach ($params as $key) {
            unset($this->params[$key]);
        }
    }


}
