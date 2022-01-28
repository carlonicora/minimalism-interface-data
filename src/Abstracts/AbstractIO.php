<?php
namespace CarloNicora\Minimalism\Interfaces\Data\Abstracts;

use CarloNicora\Minimalism\Enums\HttpCode;
use CarloNicora\Minimalism\Exceptions\MinimalismException;
use CarloNicora\Minimalism\Factories\ObjectFactory;
use CarloNicora\Minimalism\Interfaces\Data\Interfaces\DataInterface;
use CarloNicora\Minimalism\Interfaces\Data\Interfaces\DataObjectInterface;
use CarloNicora\Minimalism\Interfaces\SimpleObjectInterface;
use Exception;

abstract class AbstractIO implements SimpleObjectInterface
{
    /**
     * @param ObjectFactory $objectFactory
     * @param DataInterface $data
     */
    public function __construct(
        protected ObjectFactory $objectFactory,
        protected DataInterface $data,
    )
    {
    }

    /**
     * @param array $recordset
     * @param string|null $recordType
     * @return array
     * @throws Exception
     */
    protected function returnSingleValue(
        array $recordset,
        ?string $recordType=null,
    ): array
    {
        if ($recordset === [] || $recordset === [[]]){
            throw new MinimalismException(
                status: HttpCode::NotFound,
                message: $recordType === null
                    ? 'Record Not found'
                    : $recordType . ' not found',
            );
        }

        return array_is_list($recordset) ? $recordset[0] : $recordset;
    }

    /**
     * @param array $recordset
     * @param string $objectType
     * @return DataObjectInterface
     * @throws Exception
     */
    protected function returnSingleObject(
        array $recordset,
        string $objectType,
    ): DataObjectInterface
    {
        if ($recordset === [] || $recordset === [[]]){
            throw new MinimalismException(
                status: HttpCode::NotFound,
                message: 'Record Not found',
            );
        }

        return new $objectType(
            objectFactory: $this->objectFactory,
            data: array_is_list($recordset) ? $recordset[0] : $recordset,
        );
    }

    /**
     * @param array $recordset
     * @param string $objectType
     * @return DataObjectInterface[]
     */
    protected function returnObjectArray(
        array $recordset,
        string $objectType,
    ): array
    {
        $response = [];

        if (array_is_list($recordset)) {
            foreach ($recordset ?? [] as $record) {
                $response[] = new $objectType(
                    objectFactory: $this->objectFactory,
                    data: $record,
                );
            }
        } else {
            $response[] = new $objectType(
                objectFactory: $this->objectFactory,
                data: $recordset,
            );
        }

        return $response;
    }
}