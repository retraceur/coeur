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

ltrsuffix="-ltr"
noltrname=""

for d in *
	do
	cd $d
	for f in *
		do
		if [[ "$f" == *".min.css" ]];
		then
			echo "Processing $f from $d"
			nf=${f/${ltrsuffix}/${noltrname}}
			mv $f ../../wp-includes/css/dist/$d/$nf
		else
			echo "$f was skipped."
		fi
	done
	cd ..
done

status "Done."
