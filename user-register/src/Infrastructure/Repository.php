<?php

namespace Infrastructure;

use PDO;
use ReflectionClass;

abstract class Repository
{

    protected string $table_name = '';

    protected $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=oop", 'root', 'root');

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    private function getFieldsData(Model $model): array
    {

        $modelData = new ReflectionClass($model);

        $fieldData = [];
        foreach ($modelData->getMethods() as $method) {

            if ($method->name !== '__construct') {
                $methodName = $method->name;
                array_push($fieldData, $model->$methodName());
            }
        }
        return $fieldData;
    }


    private function getFieldsName(Model $model): array
    {

        $modelData = new ReflectionClass($model);

        $fieldsName = [];

        foreach ($modelData->getProperties() as $property) {
            array_push($fieldsName, $property->name);
        }
        return $fieldsName;
    }

    public function save(Model $model): void
    {
        $fieldsData = $this->getFieldsData($model);
        $fieldsName = $this->getFieldsName($model);

        $fieldsNameData = implode(',', $fieldsName);
        $fieldsNameParam = array_map(function ($item) {
            return ":$item";
        }, $fieldsName);
        $fieldsNameParamString = implode(', ', $fieldsNameParam);

        $stmt = $this->conn->prepare("INSERT INTO {$this->table_name} ({$fieldsNameData})
        VALUES ({$fieldsNameParamString})");

        foreach ($fieldsName as $key => $fieldName) {
            $stmt->bindParam(":$fieldName", $fieldsData[$key]);
        }

        $stmt->execute();
    }

    public function find(string $field, string $value): array
    {
        $sql = "SELECT * FROM {$this->table_name} WHERE {$field} = :{$field}";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":{$field}", $value);
        $stmt->execute();
        $data = $stmt->fetchAll(); 
     
        return $data;
    }
}
