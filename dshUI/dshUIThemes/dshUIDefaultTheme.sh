#!/bin/bash

set -o posix

# Just apply text styles
NORMAL_TEXT="$(setTextStyleCode 0)"
BOLD_TEXT="$(setTextStyleCode 0)$(setTextStyleCode 1)"
UNDERLINED_TEXT="$(setTextStyleCode 0)$(setTextStyleCode 4)"
BLINKING_TEXT="$(setTextStyleCode 0)$(setTextStyleCode 5)"
REVERSE_TEXT="$(setTextStyleCode 0)$(setTextStyleCode 7)"

# Reset text styles, and then apply color
NORMAL_COLOR_1="$(setTextStyleCode 0)$(setTextStyleCode 30)"
NORMAL_COLOR_2="$(setTextStyleCode 0)$(setTextStyleCode 31)"
NORMAL_COLOR_3="$(setTextStyleCode 0)$(setTextStyleCode 32)"
NORMAL_COLOR_4="$(setTextStyleCode 0)$(setTextStyleCode 33)"
NORMAL_COLOR_5="$(setTextStyleCode 0)$(setTextStyleCode 34)"
NORMAL_COLOR_6="$(setTextStyleCode 0)$(setTextStyleCode 35)"
NORMAL_COLOR_7="$(setTextStyleCode 0)$(setTextStyleCode 36)"
NORMAL_COLOR_8="$(setTextStyleCode 0)$(setTextStyleCode 37)"
NORMAL_COLOR_9="$(setTextStyleCode 0)$(setTextStyleCode 40)"
NORMAL_COLOR_10="$(setTextStyleCode 0)$(setTextStyleCode 41)"
NORMAL_COLOR_11="$(setTextStyleCode 0)$(setTextStyleCode 42)"
NORMAL_COLOR_12="$(setTextStyleCode 0)$(setTextStyleCode 43)"
NORMAL_COLOR_13="$(setTextStyleCode 0)$(setTextStyleCode 44)"
NORMAL_COLOR_14="$(setTextStyleCode 0)$(setTextStyleCode 45)"
NORMAL_COLOR_15="$(setTextStyleCode 0)$(setTextStyleCode 46)"
NORMAL_COLOR_16="$(setTextStyleCode 0)$(setTextStyleCode 47)"

# Apply color and bold text style
BOLD_COLOR_1="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 30)"
BOLD_COLOR_2="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 31)"
BOLD_COLOR_3="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 32)"
BOLD_COLOR_4="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 33)"
BOLD_COLOR_5="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 34)"
BOLD_COLOR_6="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 35)"
BOLD_COLOR_7="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 36)"
BOLD_COLOR_8="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 37)"
BOLD_COLOR_9="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 40)"
BOLD_COLOR_10="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 41)"
BOLD_COLOR_11="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 42)"
BOLD_COLOR_12="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 43)"
BOLD_COLOR_13="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 44)"
BOLD_COLOR_14="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 45)"
BOLD_COLOR_15="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 46)"
BOLD_COLOR_16="$(setTextStyleCode 0)$(setTextStyleCode 1)$(setTextStyleCode 47)"

# Apply color and underline text color
UNDERLINED_COLOR_1="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 30)"
UNDERLINED_COLOR_2="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 31)"
UNDERLINED_COLOR_3="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 32)"
UNDERLINED_COLOR_4="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 33)"
UNDERLINED_COLOR_5="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 34)"
UNDERLINED_COLOR_6="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 35)"
UNDERLINED_COLOR_7="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 36)"
UNDERLINED_COLOR_8="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 37)"
UNDERLINED_COLOR_9="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 40)"
UNDERLINED_COLOR_10="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 41)"
UNDERLINED_COLOR_11="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 42)"
UNDERLINED_COLOR_12="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 43)"
UNDERLINED_COLOR_13="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 44)"
UNDERLINED_COLOR_14="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 45)"
UNDERLINED_COLOR_15="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 46)"
UNDERLINED_COLOR_16="$(setTextStyleCode 0)$(setTextStyleCode 4)$(setTextStyleCode 47)"

# Apply color and blinking text style (blinking may not work on all systems)
BLINKING_COLOR_1="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 30)"
BLINKING_COLOR_2="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 31)"
BLINKING_COLOR_3="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 32)"
BLINKING_COLOR_4="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 33)"
BLINKING_COLOR_5="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 34)"
BLINKING_COLOR_6="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 35)"
BLINKING_COLOR_7="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 36)"
BLINKING_COLOR_8="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 37)"
BLINKING_COLOR_9="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 40)"
BLINKING_COLOR_10="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 41)"
BLINKING_COLOR_11="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 42)"
BLINKING_COLOR_12="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 43)"
BLINKING_COLOR_13="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 44)"
BLINKING_COLOR_14="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 45)"
BLINKING_COLOR_15="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 46)"
BLINKING_COLOR_16="$(setTextStyleCode 0)$(setTextStyleCode 5)$(setTextStyleCode 47)"

# Apply color and reverse text style
REVERSE_COLOR_1="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 30)"
REVERSE_COLOR_2="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 31)"
REVERSE_COLOR_3="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 32)"
REVERSE_COLOR_4="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 33)"
REVERSE_COLOR_5="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 34)"
REVERSE_COLOR_6="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 35)"
REVERSE_COLOR_7="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 36)"
REVERSE_COLOR_8="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 37)"
REVERSE_COLOR_9="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 40)"
REVERSE_COLOR_10="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 41)"
REVERSE_COLOR_11="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 42)"
REVERSE_COLOR_12="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 43)"
REVERSE_COLOR_13="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 44)"
REVERSE_COLOR_14="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 45)"
REVERSE_COLOR_15="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 46)"
REVERSE_COLOR_16="$(setTextStyleCode 0)$(setTextStyleCode 7)$(setTextStyleCode 47)"

