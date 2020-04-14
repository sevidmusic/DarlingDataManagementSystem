<?php
function getPositionSelector(): string
{
    $options = [];
    for ($i = 0; $i <= 500; $i++) {
        array_push($options, sprintf('<option>%s</option>', strval(($i / 100))));
    }
    return sprintf('<select name="position">%s</select>', implode(PHP_EOL . '    ', $options));
}

?>
<body class="gradientBg">
<div id="welcome" class="genericContainer genericContainerLimitedHeight"><h1 class="noticeText">Welcome</h1>
    <p class="successText">
        This is a demonstration the possible relationships/interactions of a<span class="highlightText"> Request</span>,
        <span class="highlightText"> Router</span>, <span class="highlightText"> Response</span>,
        <span class="highlightText"> Crud</span>,<span class="highlightText"> Template</span>, and
        <span class="highlightText"> OutputComponent</span>.
    </p>
    <p class="successText">
        It currently demonstrates how a stored <span class="highlightText"> Response</span> that responds
        to the current <span class="highlightText"> Request</span> can be used to determine what
        <span class="highlightText"> OutputComponent(s)</span>
        is/are used to generate output for the <span class="highlightText"> Request</span>, and which <span
                class="highlightText"> Template(s)</span> is/are used to
        organize that output.
    </p></div>
<div id="formContainer" class="genericContainer">
    <p class="genericText">
        The <a href="#form">form</a> below can be used to generate a <span class="highlightText">Response</span> to a
        <span class="highlightText"> Request</span>. The form allows you to specify the<span class="highlightText"> Request\'s</span>
        Url, the <span class="highlightText">Request\'s</span> Name, and the Output that should be
        shown in <span class="highlightText">Response</span> to the <span class="highlightText">Request</span>.<br>
        <span class="noticeText miniText">Note: The form provides default values so if your in a hurry you can
            just click the <span
                    class="highlightText">"Generate Stored Components For Mock Request"</span> button.</span>
    </p>
    <form id="form" class="genericContainer" action="/WorkingDemo.php" method="post">

        <div class="submitButtonContainer">
            <input type="submit" value="Generate Stored Components For Mock Request">
        </div>

        <div class="textInputContainer">
            <label class="formLabelText" for="requestUrl">Request Url:</label>
            <input class="input textInput" type="text" id="requestUrl" name="requestUrl"
                   value="http://192.168.33.10/WorkingDemo.php">
        </div>

        <div class="textInputContainer">
            <label class="formLabelText" for="requestName">Request Name:</label>
            <input class="input textInput" type="text" id="requestName" name="requestName" value="Working Demo">
        </div>

        <div class="selectMenuContainer" style="margin-top: 1em; margin-right:5em; float: right;">
            <span class="formLabelText">Output Position <span class="highlightText">( Relative to other existing output )</span> :</span>
            <?php echo getPositionSelector(); ?>
        </div>

        <div class="textAreaContainer">
            <label class="formLabelText" for="output">Output to show in Response to this Request:</label><br>
            <textarea class="input textareaInput" id="output" name="output"><h2 class="highlightText">Title</h2>
<p class="successText">Quos omnis omnis aut fugit mollitia debitis iusto. Non harum eos eligendi aut aut expedita. Consequatur qui dolorem consequatur incidunt temporibus nam quasi et.</p>
<table class="genericContainer">
  <tr>
    <td class="genericContainer genericText">Generic Text Color</td>
    <td class="genericContainer noticeText">Notice Text Color</td>
    <td class="genericContainer warningText">Warning Text Color</td>
  </tr>
  <tr>
    <td class="genericContainer errorText">Error Text Color</td>
    <td class="genericContainer successText">Success Text Color</td>
    <td class="genericContainer failureText">Failure Text Color</td>
  </tr>
  <tr>
    <td class="genericContainer formLabelText">Form Label Text Color</td>
    <td class="genericContainer highlightText">Highlight Text Color</td>
    <td class="genericContainer genericText miniText">Mini Text Size</td>
  </tr>
</table></textarea>
        </div>

        <div style="clear: both"></div>

        <input type="hidden" name="requestLocation" value="Demo">
        <input type="hidden" name="requestContainer" value="Request">

        <div class="submitButtonContainer">
            <input type="submit" value="Generate Stored Components For Mock Request">
        </div>
    </form>
</div>


<script>
    let coll = document.getElementsByClassName("collapsibleButton");
    let i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            this.classList.toggle("active");
            let content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>

</body>
