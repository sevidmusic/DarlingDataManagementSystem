#!/bin/bash

initVars() {
    COMPONENT_TEST_TRAIT_TARGET_ROOT_DIR="./Tests/Unit/interfaces/component";
    COMPONENT_ABSTRACT_TEST_TARGET_ROOT_DIR="./Tests/Unit/abstractions/component";
    COMPONENT_TEST_TARGET_ROOT_DIR="./Tests/Unit/classes/component";
    COMPONENT_INTERFACE_TARGET_ROOT_DIR="./core/interfaces/component";
    COMPONENT_ABSTRACTION_TARGET_ROOT_DIR="./core/abstractions/component";
    COMPONENT_CLASS_TARGET_ROOT_DIR="./core/classes/component";
}

writeWordSleep() {
    printf "${1}";
    sleep "${2}";
}

sleepWriteWord() {
    sleep "${2}";
    printf "${1}";
}

sleepWriteWordSleep() {
    sleep "${2}";
    printf "${1}";
    sleep "${2}";
}

showLoadingBar() {
    sleepWriteWordSleep "${1}" .3;
    INC=0;
    while [ $INC -le 42 ]
    do
        sleepWriteWordSleep ":" .009;
        INC=$(($INC + 1));
    done;
    echo "[100%]";
    sleep 0.42;
    clear;
}

notifyUser() {
    MSG=$(printf "\n${1}\n");
    printf "\n${1}\n";
}

promptUser() {
    notifyUser "${1}";
    PROMPT_MSG=$(printf "\n\$dsh: ");
    PREVIOUS_USER_INPUT="${USER_INPUT}";
    read -p "${PROMPT_MSG}" USER_INPUT;
}

promptUserAndVerifyInput() {
    while :
    do
        clear;

        promptUser "${1}";

        clear;

        notifyUser  "You entered \"${USER_INPUT}\"\n\nIs this correct?";

        if [ "${USER_INPUT}" = "Y" ]; then
            clear;
            break;
        fi

        promptUser "If so, type \"Y\" and press <enter> to continue,\npress <enter> repeat last step.";

        if [ "${USER_INPUT}" = "Y" ]; then
            clear;
            break;
        fi
    done;

}

promptUserAndNotify() {
    while :
    do
        clear;

        promptUser "${1}";

        clear;

        if [ "${USER_INPUT}" = "Y" ]; then
            showLoadingBar "${2}";
            clear;
            break;
        fi

    done;

}

generatePHPCodeFromTemplate() {
    TEMPLATE="${1}";
    GENERATED_FILE_ROOT_DIR_PATH="${2}";
    FILE_NAME_SUFFIX="${3}";
    GENERATED_FILE_PATH=$(echo "${GENERATED_FILE_ROOT_DIR_PATH}/${USER_DEFINED_COMPONENT_SUBTYPE}/${USER_DEFINED_COMPONENT_NAME}${FILE_NAME_SUFFIX}.php" | sed -E "s,\\\,/,g; s,//,/,g;");
    if [ "${FILE_NAME_SUFFIX}" = "TestTrait" ]; then
        GENERATED_FILE_PATH=$(echo "${GENERATED_FILE_ROOT_DIR_PATH}/${USER_DEFINED_COMPONENT_SUBTYPE}/TestTraits/${USER_DEFINED_COMPONENT_NAME}${FILE_NAME_SUFFIX}.php" | sed -E "s,\\\,/,g; s,//,/,g;");
    fi;
    PHP_CODE=$(sed -E "s/DS_PARENT_COMPONENT_SUBTYPE/${USER_DEFINED_PARENT_COMPONENT_SUBTYPE}/g; s/DS_PARENT_COMPONENT_NAME/${USER_DEFINED_PARENT_COMPONENT_NAME}/g; s/DS_COMPONENT_SUBTYPE/${USER_DEFINED_COMPONENT_SUBTYPE}/g; s/DS_COMPONENT_NAME/${USER_DEFINED_COMPONENT_NAME}/g; s/[$][A-Z]/\L&/g; s/->[A-Z]/\L&/g; s/\\\\\\\/\\\/g; s/\\\;/;/g;" "${1}");
    GENERATED_FILE_SUB_DIR_PATH=$(echo "${GENERATED_FILE_PATH}" | sed -E "s/\/${USER_DEFINED_COMPONENT_NAME}${FILE_NAME_SUFFIX}.php//g");
    printf "The following code was generated using the ${TEMPLATE} template, please review it to make sure there are not any errors:\n\n";
    echo "${PHP_CODE}";
    promptUser "\n\nIf everything looks ok press <enter>";
    showLoadingBar "Writing file ${GENERATED_FILE_PATH} ";
    mkdir -p "${GENERATED_FILE_SUB_DIR_PATH}";
    echo "${PHP_CODE}" > "${GENERATED_FILE_PATH}";
}

askUserForComponentName() {
    promptUserAndVerifyInput "Please enter a name for the component";
    USER_DEFINED_COMPONENT_NAME="${PREVIOUS_USER_INPUT}";
}

askUserForComponentSubtype() {
    promptUserAndVerifyInput "Please enter the component's sub-type, the sub-type\ndetermines the namespace pattern used to define the namespaces\nof the interface, implementations, test trait, and test classes\nrelated to the component.\n\nExample namespace pattern:\n\\DarlingCms\\\*\\component\\SUB\\TYPE\\${USER_DEFINED_COMPONENT_NAME}\n\nNote: You must escape backslash characters.\n\nNote: Do not inlcude a preceding backslash in the sub-type.\nWrong: \\\\Foo\\\\Bar\nRight: Foo\\\\Bar\n";
    USER_DEFINED_COMPONENT_SUBTYPE=$(echo "${PREVIOUS_USER_INPUT}" | sed 's,\\,\\\\,g');
}

askUserForParentComponentName() {
    promptUserAndVerifyInput "Please enter the name of the component this component extends:";
    USER_DEFINED_PARENT_COMPONENT_NAME="${PREVIOUS_USER_INPUT}";
}

askUserForParentComponentSubtype() {
    promptUserAndVerifyInput "Please enter the subtype of the component this component extends:";
    USER_DEFINED_PARENT_COMPONENT_SUBTYPE="${PREVIOUS_USER_INPUT}";
}

showWelcomeMessage() {
    clear;
    sleepWriteWordSleep "\nW" .03;
    sleepWriteWordSleep "e" .03;
    sleepWriteWordSleep "l" .03;
    sleepWriteWordSleep "c" .03;
    sleepWriteWordSleep "o" .03;
    sleepWriteWordSleep "m" .03;
    sleepWriteWordSleep "e" .03;
    sleepWriteWordSleep " " .03;
    sleepWriteWordSleep "t" .03;
    sleepWriteWordSleep "h" .03;
    sleepWriteWordSleep "e" .03;
    sleepWriteWordSleep " " .03;
    sleepWriteWordSleep "D" .03;
    sleepWriteWordSleep "a" .03;
    sleepWriteWordSleep "r" .03;
    sleepWriteWordSleep "l" .03;
    sleepWriteWordSleep "i" .03;
    sleepWriteWordSleep "n" .03;
    sleepWriteWordSleep "g" .03;
    sleepWriteWordSleep " " .03;
    sleepWriteWordSleep "S" .03;
    sleepWriteWordSleep "h" .03;
    sleepWriteWordSleep "e" .03;
    sleepWriteWordSleep "l" .03;
    sleepWriteWordSleep "l\n" .03;
    showLoadingBar "Loading New Component Module";
}

askUserForTemplateDirectoryName() {
    promptUserAndVerifyInput "Please enter the name of the directory where the appropriate php code templates are located:";
    TEMPLATE="${PREVIOUS_USER_INPUT}";

    while [ ! -d "./templates/${TEMPLATE}" ]
    do
        promptUserAndVerifyInput "The specified template directory does not exist, please enter an existing template directory's name";
        TEMPLATE="${PREVIOUS_USER_INPUT}";
    done;

    TEST_TRAIT_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/TestTrait.php";
    ABSTRACT_TEST_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/AbstractTest.php";
    TEST_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Test.php";
    INTERFACE_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Interface.php";
    ABSTRACTION_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Abstraction.php";
    CLASS_TEMPLATE_FILE_PATH="./templates/${TEMPLATE}/Class.php";
}
while :
do
    initVars;
    showWelcomeMessage;
    askUserForTemplateDirectoryName;
    askUserForParentComponentName;
    askUserForParentComponentSubtype;
    askUserForComponentName;
    askUserForComponentSubtype;
    generatePHPCodeFromTemplate "${TEST_TRAIT_TEMPLATE_FILE_PATH}" "${COMPONENT_TEST_TRAIT_TARGET_ROOT_DIR}" "TestTrait";
    generatePHPCodeFromTemplate "${ABSTRACT_TEST_TEMPLATE_FILE_PATH}" "${COMPONENT_ABSTRACT_TEST_TARGET_ROOT_DIR}" "Test";
    generatePHPCodeFromTemplate "${TEST_TEMPLATE_FILE_PATH}" "${COMPONENT_TEST_TARGET_ROOT_DIR}" "Test";
    generatePHPCodeFromTemplate "${INTERFACE_TEMPLATE_FILE_PATH}" "${COMPONENT_INTERFACE_TARGET_ROOT_DIR}" "";
    generatePHPCodeFromTemplate "${ABSTRACTION_TEMPLATE_FILE_PATH}" "${COMPONENT_ABSTRACTION_TARGET_ROOT_DIR}" "";
    generatePHPCodeFromTemplate "${CLASS_TEMPLATE_FILE_PATH}" "${COMPONENT_CLASS_TARGET_ROOT_DIR}" "";
    break;

done;

