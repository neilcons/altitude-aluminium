<?php  
/*
 * builds a bootstrap formatted dropdown element with options when given the following data
 *
 *  REQUIRED
 *  - id            = the id to assign to the button
 *  - options       = array of options to place into the dropdown, expects two keys : value + text
 *                      => value    = the value that will be placed in the target
 *                      => text     = the text to display in the dropdown option
 *                      
 *  OPTIONAL
 *  - target        = the name of the field in which to place the selected options value
 *  - update_image  = instructs the image to be updated
 *
 */

// ensure the required data is here first !!
if( !isset($id) || !isset($options) || ( isset($id) && $id == '' ) || ( isset($options) && $options == '' ) ) {
    // nope - we don't have enough data to draw this dropdown
    return;
}

// set the data attributes to add to the top level div container for this dropdown
$sContainerDataAttributes = '';
$sContainerDataAttributes .= isset($target) ? 'data-target="'. $target .'" ' : '';
$sContainerDataAttributes .= isset($update_image) ? 'data-update-image="'. $update_image .'" ' : '';
?>

<div id="dropdown-<?php echo $id; ?>" class="dropdown" <?php echo $sContainerDataAttributes; ?>>
    <button class="btn btn-default dropdown-toggle" type="button" id="<?php echo $id; ?>" data-toggle="dropdown" area-expanded="true">
        <span class="title">
            <?php echo $options[0]['text']; ?>
        </span>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu" area-labelledby="<?php echo $id; ?>">
        <?php foreach( $options as $key => $value ) :?>
        <li role="<?php echo $id .'-option'; ?>">
            <a role="item" tabindex="<?php echo ( $key+1 ); ?>" href="#" data-value="<?php echo $value['value']; ?>">
                <?php echo $value['text']; ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>