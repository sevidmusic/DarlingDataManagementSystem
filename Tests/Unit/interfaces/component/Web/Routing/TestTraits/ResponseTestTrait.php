<?php

namespace UnitTests\interfaces\component\Web\Routing\TestTraits;

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\JsonStorageDriver as CoreJsonStorageDriver;
use DarlingDataManagementSystem\classes\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\classes\component\Web\Routing\Response as CoreResponse;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;

trait ResponseTestTrait
{

    private ResponseInterface $response;

    public function testPositionablePropertyIsAssignedAPositionableImplementationInstancePostInstantiation(): void
    {
        $classImplements = class_implements($this->getResponse()->export()['positionable']);
        $this->assertTrue(
            in_array(
                PositionableInterface::class,
                (is_array($classImplements) ? $classImplements : [])
            )
        );
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }

    public function testRespondsToRequestReturnsTrueForAssignedRequest(): void
    {
        $request = $this->getMockRequest();
        $this->getMockCrud()->create($request);
        $this->getResponse()->addRequestStorageInfo($request);
        $this->assertTrue(
            $this->getResponse()->respondsToRequest(
                $request,
                $this->getMockCrud()
            ),
            'respondsToRequest() must return true for assigned request.'
        );
    }

    public function testRespondsToRequestReturnsTrueForAnyRequestWhoseAssignedUrlContainsAGetParameterNamed_request_WhoseAssignedValueMatchesRespectiveResponsesName(): void
    {
        $unassignedRequestUrlDefinesGetParam_request_WithValueResponseName = $this->getMockRequest();
        $unassignedRequestUrlDefinesGetParam_request_WithValueResponseName->import(['url' => 'http://DEFAULT/index.php?request=' . $this->getResponse()->getName()]);
        $this->assertTrue(
            $this->getResponse()->respondsToRequest(
                $unassignedRequestUrlDefinesGetParam_request_WithValueResponseName,
                $this->getMockCrud()
            ),
            'respondsToRequest() must return true for any Request that defines a GET parameter named \'request\' whose assigned value matches the respective Response\'s name.'
        );
    }

    protected function getMockRequest(): CoreRequest
    {
        $request = new CoreRequest(
            $this->getMockStorable(),
            $this->getMockSwitchable()
        );
        $request->import(
            [
                'url' => 'http://www.example.com/admin.php?foo=bar&baz=bazzer',
                'get' => [
                    'foo' => 'bar',
                    'baz' => 'bazzer'
                ],
                'post' => [
                    'foobarbaz'
                ]
            ]
        );
        return $request;
    }

    private function getMockStorable(): CoreStorable
    {
        return new CoreStorable(
            'MockName',
            'MockLocation',
            'MockContainer'
        );
    }

    private function getMockSwitchable(): CoreSwitchable
    {
        return new CoreSwitchable();
    }

    protected function getMockCrud(): ComponentCrudInterface
    {
        return new CoreComponentCrud(
            new CoreStorable('MockCrud', 'MockCrudLocation', 'MockCrudContainer'),
            new CoreSwitchable(),
            new CoreJsonStorageDriver(
                new CoreStorable(
                    'MockStandardStorageDriver',
                    'MockStandardStorageDriverLocation',
                    'MockStandardStorageDriverContainer'
                ),
                new CoreSwitchable()
            )
        );
    }

    public function testRespondsToRequestReturnsFalseForUnknownRequest(): void
    {
        $this->assertFalse(
            $this->getResponse()->respondsToRequest(
                $this->getMockRequest(),
                $this->getMockCrud()
            ),
            'respondsToRequest() must return false for unknown request.'
        );
    }

    public function testAddOutputComponentStorageInfoAddsSpecifiedOutputComponentsStorableInstance(): void
    {
        $initialCount = count(
            $this->getResponse()->export()['outputComponentStorageInfo']
        );
        $this->getResponse()->addOutputComponentStorageInfo(
            $this->getMockOutputComponent()
        );
        $this->assertTrue(
            (
                count($this->getResponse()->export()['outputComponentStorageInfo'])
                >
                $initialCount
            ),
            'addOutput() failed to add output component\'s storable instance.'
        );
    }

    private function getMockOutputComponent(): CoreOutputComponent
    {
        return new CoreOutputComponent(
            $this->getMockStorable(),
            $this->getMockSwitchable(),
            new CorePositionable()
        );
    }

    public function testRemoveOutputComponentStorageInfoRemovesSpecifiedOutputComponentsStorableInstance(): void
    {
        $outputComponent = $this->getMockOutputComponent();
        $this->getResponse()->addOutputComponentStorageInfo($outputComponent);
        $count = count(
            $this->getResponse()->export()['outputComponentStorageInfo']
        );
        $this->getResponse()->removeOutputComponentStorageInfo(
            $outputComponent->getName()
        );
        $this->assertTrue(
            (
                count($this->getResponse()->export()['outputComponentStorageInfo'])
                <
                $count
            ),
            'Failed removing output component storage info by name'
        );
        $this->getResponse()->addOutputComponentStorageInfo($outputComponent);
        $count = count(
            $this->getResponse()->export()['outputComponentStorageInfo']
        );
        $this->getResponse()->removeOutputComponentStorageInfo(
            $outputComponent->getUniqueId()
        );
        $this->assertTrue(
            (
                count($this->getResponse()->export()['outputComponentStorageInfo'])
                <
                $count
            ),
            'Failed removing output component storage info by unique id'
        );
    }

    public function testGetRequestStorageInfoReturnsArrayOfStorableInstancesForAssignedRequests(): void
    {
        $this->turnSwitchableComponentOn($this->getResponse());
        $request = $this->getMockRequest();
        $this->getResponse()->addRequestStorageInfo($request);
        $this->assertEquals(
            [$request->export()['storable']],
            $this->getResponse()->getRequestStorageInfo(),
            'getRequestStorageInfo() did not return array of storable instances for assigned output components.'
        );
    }

    public function testGetOutputComponentStorageInfoReturnsArrayOfStorableInstancesForAssignedOutputComponents(): void
    {
        $this->turnSwitchableComponentOn($this->getResponse());
        $outputComponent = $this->getMockOutputComponent();
        $this->getResponse()->addOutputComponentStorageInfo($outputComponent);
        $this->assertEquals(
            [$outputComponent->export()['storable']],
            $this->getResponse()->getOutputComponentStorageInfo(),
            'getOutputComponentStorageInfo() did not return array of storable instances for assigned output components.'
        );
    }

    public function testGetOutputComponentStorageInfoReturnsEmptyArrayIfStateIsFalse(): void
    {
        $this->turnSwitchableComponentOff($this->getResponse());
        $this->getResponse()->addOutputComponentStorageInfo(
            $this->getMockOutputComponent()
        );
        $this->assertEmpty(
            $this->getResponse()->getOutputComponentStorageInfo(),
            'getOutputComponentStorageInfo() must return an empty array if state is false.'
        );
    }

    public function testAddORequestStorageInfoAddsSpecifiedORequestsStorableInstance(): void
    {
        $initialCount = count(
            $this->getResponse()->export()['requestStorageInfo']
        );
        $this->getResponse()->addRequestStorageInfo($this->getMockRequest());
        $this->assertTrue(
            (
                count($this->getResponse()->export()['requestStorageInfo'])
                >
                $initialCount
            ),
            'addOutput() failed to add output component\'s storable instance.'
        );
    }

    public function testRemoveRequestStorageInfoRemovesSpecifiedRequestsStorableInstance(): void
    {
        $request = $this->getMockRequest();
        $this->getResponse()->addRequestStorageInfo($request);
        $count = count($this->getResponse()->export()['requestStorageInfo']);
        $this->getResponse()->removeRequestStorageInfo($request->getName());
        $this->assertTrue(
            (
                count($this->getResponse()->export()['requestStorageInfo'])
                <
                $count
            ),
            'Failed removing request storage info by name.'
        );
        $this->getResponse()->addRequestStorageInfo($request);
        $count = count($this->getResponse()->export()['requestStorageInfo']);
        $this->getResponse()->removeRequestStorageInfo(
            $request->getUniqueId()
        );
        $this->assertTrue(
            (
                count($this->getResponse()->export()['requestStorageInfo'])
                <
                $count
            ),
            'Failed removing request storage info by id.'
        );
    }

    public function testRESPONSE_CONTAINERConstantIsAssignedStringRESPONSES(): void
    {
        $this->assertEquals("RESPONSES", $this->getResponse()::RESPONSE_CONTAINER);
        $this->assertEquals("RESPONSES", CoreResponse::RESPONSE_CONTAINER);
    }

    public function testGetContainerReturnsValueOfRESPONSE_CONTAINERConstant(): void
    {
        $this->assertEquals(
            $this->getResponse()::RESPONSE_CONTAINER,
            $this->getResponse()->getContainer()
        );
        $this->assertEquals(
            $this->getResponse()::RESPONSE_CONTAINER,
            $this->getResponse()->export()['storable']->getContainer()
        );
    }

    protected function setResponseParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getResponse());
        $this->setSwitchableComponentParentTestInstances();
    }

}
