<?php

namespace Extensions\Contests\core\abstractions\component\Contest;

use DarlingDataManagementSystem\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\interfaces\primary\Positionable;
use DarlingDataManagementSystem\interfaces\primary\Storable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;
use DateTime;
use Extensions\Contests\core\classes\component\Contest\User;
use Extensions\Contests\core\interfaces\component\Contest\Submission as SubmissionInterface;
use RuntimeException;

abstract class Submission extends CoreOutputComponent implements SubmissionInterface
{

    private const DEFAULT_OUTPUT_SPRINT = '<p>Submission Name: %s</p><p>Submission Type: %s</p><p>Submitted On: %s</p><p>Submitted By: %s</p><p>Submission Url: <a href="%s">%s</a></p><div><iframe src="%s"></iframe></div>';
    private const ERROR_MALFORMED_URL = 'Warning: Submission "%s" with id "%s" is assigned a malformed url "%s"';
    private $submitter;
    private $url;
    private $dateTimeOfSubmission;
    private $metaData = [];

    public function __construct(
        Storable $storable,
        Switchable $switchable,
        Positionable $positionable,
        User $submitter,
        string $url
    )
    {
        $this->dateTimeOfSubmission = new DateTime('now');
        $this->url = $url;
        $this->submitter = $submitter;
        parent::__construct($storable, $switchable, $positionable);
    }

    public function getSubmitter(): User
    {
        return $this->submitter;
    }

    public function assignMetaData(string $key, $value): void
    {
        $this->metaData[$key] = $value;
    }

    public function getOutput(): string
    {
        return (
        $this->getState() === false
            ? ''
            : sprintf(
            self::DEFAULT_OUTPUT_SPRINT,
            $this->getName(),
            str_replace(
                'Extensions\Contests\core\classes\component\Contest\\',
                '',
                $this->getType()
            ),
            $this->dateTimeOfSubmission->format('Y-m-d @ h:i a'),
            $this->export()['submitter']->getName(),
            $this->getUrl(),
            $this->getUrl(),
            $this->getUrl()
        )
        );
    }

    public function getUrl(): string
    {
        if ($this->urlIsProperlyFormatted() === false) {
            throw new RuntimeException(sprintf(self::ERROR_MALFORMED_URL, $this->getName(), $this->getUniqueId(), $this->url));
        }
        return $this->url;
    }

    private function urlIsProperlyFormatted(): bool
    {
        return 1 === preg_match("/\b(?:(?:https?):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->url);
    }

}
