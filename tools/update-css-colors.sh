#!/bin/bash

# Exit if any command fails
set -e

# Change to the expected directory
cd ./built

# Enable nicer messaging for build status
YELLOW_BOLD='\033[1;33m';
COLOR_RESET='\033[0m';
status () {
	echo -e "\n${YELLOW_BOLD}$1${COLOR_RESET}\n"
}

# Rename assets
status "Moving built CSS assets..."

for f in *
	do
	if [[ "$f" == *".min.css" ]];
		then
			echo "Processing $f"
			mv $f ../wp-admin/css/colors/retraceur
		else
			echo "$f was skipped."
	fi

done

status "Done."
