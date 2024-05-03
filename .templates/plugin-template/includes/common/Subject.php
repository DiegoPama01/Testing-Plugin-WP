<?php
namespace __templateNameToPascalCase__\Common;
interface Subject
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}
