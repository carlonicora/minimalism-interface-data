<?php
namespace CarloNicora\Minimalism\Interfaces\Data\Interfaces;

interface TableInterface
{
    /**
     * @return string
     */
    public static function getTableName(): string;

    /**
     * @return array
     */
    public static function getTableFields(): array;

    /**
     * @param array $records
     * @param bool $delete
     * @param bool $avoidSingleInsert
     */
    public function update(
        array &$records,
        bool $delete = false,
        bool $avoidSingleInsert=false
    ): void;

    /**
     * @param array $records
     */
    public function delete(array $records): void;

    /**
     * @param string $fieldName
     * @param $fieldValue
     * @return array
     */
    public function byField(string $fieldName, $fieldValue): array;

    /**
     * @param $id
     * @return array
     */
    public function byId($id): array;

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param string $joinedTableName
     * @param string $joinedTablePrimaryKeyName
     * @param string $joinedTableForeignKeyName
     * @param int $joinedTablePrimaryKeyValue
     * @return array|null
     */
    public function getFirstLevelJoin(string $joinedTableName, string $joinedTablePrimaryKeyName, string $joinedTableForeignKeyName, int $joinedTablePrimaryKeyValue): ?array;
}