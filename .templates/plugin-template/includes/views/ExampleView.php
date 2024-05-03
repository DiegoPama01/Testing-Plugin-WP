<?php

namespace __templateNameToPascalCase__\Views;

class ExampleView extends View
{
    /**
     * Render method for the example view.
     */
    public function render()
    {
        // Logic to render the view
?>
        <div>Hola</div>

        <?php (new ExampleView) -> render() ?>
<?php
    }
}
