/** @type {import('tailwindcss').Config} */
const path = require('path');

module.exports = {
	content: [
		path.resolve(__dirname, '../resources/views/**/*.{html,twig}'),
		path.resolve(__dirname, '../app/**/*.php'),
	],
	theme  : {
		extend: {},
	},
	plugins: [],
};
