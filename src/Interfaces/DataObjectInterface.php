<?php
namespace CarloNicora\Minimalism\Interfaces\Data\Interfaces;

use CarloNicora\Minimalism\Factories\ObjectFactory;

interface DataObjectInterface
{
    /**
     * DataObjectInterface constructor.
     * @param ObjectFactory $objectFactory
     * @param array|null $data
     */
    public function __construct(
        ObjectFactory $objectFactory,
        ?array $data=null,
    );

    /**
     * @param array $data
     */
    public function import(
        array $data,
    ): void;

    /**
     * @return array
     */
    public function export(
    ): array;

    /**
     * @return bool
     */
    public function isNewObject(
    ): bool;

    /**
     * @return string
     */
    public function getTableInterfaceClass(
    ): string;
}