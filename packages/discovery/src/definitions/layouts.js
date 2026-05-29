const primaryField = 'full_name';
const mediaField = 'image';

const defaultLayouts = {
	table: {
		layout: {
			primaryField,
		},
		showMedia: false,
	},
	grid: {
		layout: {
			primaryField,
			mediaField,
		},
		showMedia: true,
	},
};

export default defaultLayouts;
