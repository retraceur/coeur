#!/bin/bash

# Exit if any command fails
set -e

# Change to the expected directory
cd ./../../built

# Enable nicer messaging for build status
YELLOW_BOLD='\033[1;33m';
COLOR_RESET='\033[0m';
status () {
	echo -e "\n${YELLOW_BOLD}$1${COLOR_RESET}\n"
}

# Rename assets
status "Moving built assets..."

for f in *
	do
	if [[ "$f" == *".js" ]];
		then
			echo "Processing $f"
			mv $f ../wp-admin/js
	elif [[ "$f" == *".css" ]];
		then
			echo "Processing $f"
			mv $f ../wp-admin/css
	elif [[ "$f" == *".asset.php" ]];
		then
			echo "Processing $f"
			mv $f ../wp-includes/assets
	else
		echo "$f was skipped."
	fi

done

status "Done."
