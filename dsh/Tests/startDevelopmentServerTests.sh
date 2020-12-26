#!/bin/bash
# startDevelopmentServerTests.sh

set -o posix

activeServers() {
    printf "%s" "$(ps -aux | grep -Eo 'php -S localhost:[0-9][0-9][0-9][0-9]' | sed 's,php -S localhost,http://localhost,g')"
}

numberOfActiveServers() {
    printf "%s" "$(activeServers | wc -w)"
}

testDshStartDevelopmentServerStartsADevelopmentServerWithoutError() {
    killall php &> /dev/null
    assertNoError "dsh --start-development-server" "dsh --start-development-server MUST run without error."
    assertEquals "1" "$(numberOfActiveServers)" "dsh --start-development-server MUST start a development server."
    printf "\n    \e[0m\e[104m\e[30mActive Servers:\e[0m\n    \e[0m\e[104m\e30m%s\e[0m\n" "$(activeServers)"
    killall php &> /dev/null
}

testDshStartDevelopmentServerUsesPort8080IfPORTIsNotSpecified() {
    killall php &> /dev/null
    dsh --start-development-server &> /dev/null
    assertEquals "http://localhost:8080" "$(activeServers)" "dsh --start-development-server MUST start a development server at http://localhost:8080 if <PORT> is not specified."
    killall php &> /dev/null
}

testDshStartDevelopmentServerUsesSpecifiedPORTIfPORTIsSpecified() {
    local random_port
    killall php &> /dev/null
    random_port="8${RANDOM: -3}"
    dsh --start-development-server "${random_port}" &> /dev/null
    assertEquals "http://localhost:${random_port}" "$(activeServers)" "dsh --start-development-server MUST start a development server at http://localhost:<PORT> if <PORT> is specified."
    killall php &> /dev/null
}

runTest testDshStartDevelopmentServerStartsADevelopmentServerWithoutError 2
runTest testDshStartDevelopmentServerUsesPort8080IfPORTIsNotSpecified
runTest testDshStartDevelopmentServerUsesSpecifiedPORTIfPORTIsSpecified