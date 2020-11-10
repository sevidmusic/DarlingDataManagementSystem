<?php

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;

$crud = new ComponentCrud(
    new Storable(
        'OCOverviewCrud',
        'Temp',
        'Temp'
    ),
    new Switchable(),
    new JsonStorageDriver(
        new Storable(
            'OCOverviewStorageDriver',
            'Temp',
            'Temp'
        ),
        new Switchable()
    )
);

?>
<div class="output font-concert-one">
<h2 class="overview-title font-audio-wide">Output Components</h2>
<?php
    $bgcolors = ['linear-gradient(90deg, #000000, #090909)', 'linear-gradient(90deg, #090909, #000000)'];
    $bgcolor = $bgcolors[1];
    foreach($crud->readAll($this->getLocation(), 'Output') as $outputComponent) {
        if($outputComponent->getName() !== 'OutputComponentOverview') {
            $bgcolor = ($bgcolor === $bgcolors[0] ? $bgcolors[1] : $bgcolors[0]);
            echo '
    <div id="' . $outputComponent->getUniqueId() . '" class="component-info highlight-text-color" style="background: ' . $bgcolor . ';">
        <p>Name: <span class="default-text-color">' . $outputComponent->getName() . '</span></p>
        <p>Unique Id: <span class="default-text-color">' . substr($outputComponent->getUniqueId(), 0, 17) . '...</span></p>
        <p>Storage Location: <span class="default-text-color">' . $outputComponent->getLocation() . '</span></p>
        <p>Storage Container: <span class="default-text-color">' . $outputComponent->getContainer() . '</span></p>
        <p>Position: <span class="default-text-color">' . $outputComponent->getPosition() . '</span></p>
        <p>Type: <span class="default-text-color">' . $outputComponent->getType() . '</span></p>
        <p>Output:</p>
        <div class="component-info-output-preview font-audio-wide">
        ' . str_replace(['<', '>'], ['&lt;', '&gt;' . '<br>'], $outputComponent->getOutput()) . '
        </div>
    </div>
            ';
        }
    }
?>
    <div id="<?php echo $this->getUniqueId(); ?>" class="component-info font-audio-wide note-text-color">
        <p>Name: <span class="notice-text-color"><?php echo $this->getName(); ?></span></p>
        <p>Unique Id: <span class="notice-text-color"><?php echo substr($this->getUniqueId(), 0, 17); ?></span>...</p>
        <p>Storage Location: <span class="notice-text-color"><?php echo $this->getLocation(); ?></span></p>
        <p>Storage Container: <span class="notice-text-color"><?php echo $this->getContainer(); ?></span></p>
        <p>Position: <span class="notice-text-color"><?php echo $this->getPosition(); ?></span></p>
        <p>Type: <span class="notice-text-color"><?php echo $this->getType(); ?></span></p>
        <p>Output:</p>
        <div class="component-info-output-preview">
            <p class="notice-text-color">Output preivew for this Output Component is not available becuase some of the output for the current Request is being generated by this Output Component.</p>
        </div>
    </div>
</div>
